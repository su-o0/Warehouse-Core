<?php
namespace WarehouseCore\Transaction\User;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\UserNameRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;

final class AddUserNameTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private UserRepository $user_repository,
        private UserNameRepository $user_name_repository,
        private UserProcessingStepRepository $user_processing_step_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $user_id,
        ?int $record_id,
        string $value,
        UserStatusEnum $user_status,
        int $created_by_user_id
    ): mixed{
        return $this->run(function () use (
            $user_id,
            $record_id,
            $value,
            $user_status,
            $created_by_user_id
        ) {
            try {
                $old_primary_name = $this->user_name_repository->findPrimaryByUserId(
                    user_id: $user_id
                );

                if($old_primary_name !== null) {
                    $this->user_name_repository->updatePrimary(
                        $old_primary_name->record_id,
                        false
                    );
                }

                $this->user_name_repository->add(
                    user_id: $user_id,
                    value: $value,
                    is_primary: true,
                    created_by_user_id: $created_by_user_id
                );

                if ($user_status === UserStatusEnum::Created) {
                    $this->user_repository->updateStatus(
                        $user_id,
                        UserStatusEnum::Processing->value
                    );
                }

                if ($record_id === null) {
                    $this->user_processing_step_repository->add(
                        user_id: $user_id,
                        stage: UserProcessingStepStageEnum::Named->value
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