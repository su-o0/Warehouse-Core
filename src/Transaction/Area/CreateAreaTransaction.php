<?php
namespace WarehouseCore\Transaction\Area;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Identity\AreaAccessRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Topology\AreaRepository;

final class CreateAreaTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private AreaRepository $area_repository,
        private AreaAccessRepository $area_access_repository,
        private UserRepository $user_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $user_id
    ): mixed{
        return $this->run(function () use (
            $user_id
        ) {
            try { 
                $area_id = $this->area_repository->add(
                    user_id: $user_id
                );

                $users = $this->user_repository->list();

                foreach ($users as $user) {
                    $this->area_access_repository->add(
                        area_id: $area_id,
                        user_id: $user->id,
                        created_by_user_id: $user_id
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