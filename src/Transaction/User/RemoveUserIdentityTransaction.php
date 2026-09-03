<?php
namespace WarehouseCore\Transaction\User;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;

final class RemoveUserIdentityTransaction extends Transaction {
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
        int $identity_record_id,
        int $identified_record_id,
        bool $change_status
    ): mixed{
        return $this->run(function () use (
            $user_id,
            $identity_record_id,
            $identified_record_id,
            $change_status
        ) {
            try { 
                $this->user_identity_repository->delete(
                    $identity_record_id
                );

                if($change_status) {
                    $this->user_repository->updateStatus(
                        id: $user_id,
                        status: UserStatusEnum::Processing->value
                    );
                    
                    if($identified_record_id) {
                        $this->user_processing_step_repository->delete(
                            $identified_record_id
                        );
                    }
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