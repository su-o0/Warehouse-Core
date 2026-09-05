<?php
namespace WarehouseCore\Transaction\User;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;

final class DismissUserRoleTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private UserRepository $user_repository,
        private UserProcessingStepRepository $user_processing_step_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $user_id,
        int $record_id,
        UserStatusEnum $user_status
    ): mixed{
        return $this->run(function () use (
            $user_id,
            $record_id,
            $user_status
        ) {
            $this->user_repository->updateRole(
                id: $user_id,
                role: null
            );

            $this->user_processing_step_repository->delete(
                record_id: $record_id
            );
            
            if ($user_status === UserStatusEnum::Active) {
                $this->user_repository->updateStatus(
                    $user_id,
                    UserStatusEnum::Processing->value
                );
            }

            return new ServiceResult(
                success: true
            );
        });
    }
}