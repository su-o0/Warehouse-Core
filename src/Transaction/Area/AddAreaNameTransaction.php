<?php
namespace WarehouseCore\Transaction\Area;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\AreaNameRepository;

final class AddAreaNameTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private AreaNameRepository $area_name_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $area_id,
        string $value,
        int $user_id
    ): mixed{
        return $this->run(function () use (
            $area_id,
            $value,
            $user_id
        ) {
            try {
                $primary_name = $this->area_name_repository->getPrimaryByAreaId(
                    $area_id
                );

                if($primary_name !== null) {
                    $this->area_name_repository->updatePrimary(
                        $primary_name->area_id,
                        $primary_name->value,
                        false
                    );
                }

                $this->area_name_repository->add(
                    area_id: $area_id,
                    value: $value,
                    is_primary: true,
                    user_id: $user_id
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