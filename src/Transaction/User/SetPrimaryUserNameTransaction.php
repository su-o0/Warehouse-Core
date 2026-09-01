<?php
namespace WarehouseCore\Transaction\User;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\UserNameRepository;

final class SetPrimaryUserNameTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private UserNameRepository $user_name_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $record_id,
        int $user_id
    ): mixed{
        return $this->run(function () use (
            $record_id,
            $user_id
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

                $this->user_name_repository->updatePrimary(
                    $record_id,
                    true
                );
                
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