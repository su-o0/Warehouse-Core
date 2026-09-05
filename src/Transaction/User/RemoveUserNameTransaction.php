<?php
namespace WarehouseCore\Transaction\User;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\UserNameRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;

final class RemoveUserNameTransaction extends Transaction {
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
        int $record_id,
        int $user_id,
        UserStatusEnum $user_status
    ): mixed{
        return $this->run(function () use (
            $record_id,
            $user_id,
            $user_status
        ) {
            $old_primary_name = $this->user_name_repository->findPrimaryByUserId(
                user_id: $user_id
            );

            if($old_primary_name !== null) {
                $this->user_name_repository->updatePrimary(
                    $old_primary_name->record_id,
                    false
                );
            }

            $this->user_processing_step_repository->delete(
                $record_id
            );

            if($user_status == UserStatusEnum::Active) {
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