<?php
namespace WarehouseCore\Transaction\User;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Enum\RoleNameEnum;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;

final class AssignUserRoleTransaction extends Transaction {
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
        RoleNameEnum $role,
        UserStatusEnum $user_status
    ): mixed{
        return $this->run(function () use (
            $user_id,
            $role,
            $user_status
        ) {
            $this->user_repository->updateRole(
                id: $user_id,
                role: $role->value
            );

            $this->user_processing_step_repository->add(
                user_id: $user_id,
                stage: UserProcessingStepStageEnum::AssignRole->value
            );
            
            if ($user_status === UserStatusEnum::Created) {
                $this->user_repository->updateStatus(
                    id: $user_id,
                    status: UserStatusEnum::Processing->value
                );
            }
        
            return new ServiceResult(
                success: true
            );
        });
    }
}