<?php
namespace WarehouseCore\Transaction\User;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Enum\ProviderNameEnum;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;

final class AddUserIdentityTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private UserRepository $user_repository,
        private UserIdentityRepository $user_identity_repository,
        private UserProcessingStepRepository $user_processing_step_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $user_id,
        ProviderNameEnum $provider,
        string $external_id,
        bool $identified,
        UserStatusEnum $user_status
    ): mixed{
        return $this->run(function () use (
            $user_id,
            $provider,
            $external_id,
            $identified,
            $user_status
        ) {
            try { 
                $this->user_identity_repository->add(
                    user_id: $user_id,
                    provider: $provider->value,
                    external_id: $external_id
                );

                if (!$identified) {
                    $this->user_processing_step_repository->add(
                        user_id: $user_id,
                        stage: UserProcessingStepStageEnum::Identified->value
                    );
                }

                if ($user_status === UserStatusEnum::Created) {
                    $this->user_repository->updateStatus(
                        id: $user_id,
                        status: UserStatusEnum::Processing->value
                    );
                }
            }catch(RepositoryException $e) {
                return new ServiceResult(
                    success: false,
                    message: $e->getMessage()
                );
            }

            return new ServiceResult(
                success: true
            );
        });
    }
}