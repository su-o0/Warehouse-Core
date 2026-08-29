<?php
namespace WarehouseCore\Transaction\Area;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\AreaNameRepository;

final class SetPrimaryAreaNameTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private AreaNameRepository $area_name_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $record_id,
        int $area_id
    ): mixed{
        return $this->run(function () use (
            $record_id,
            $area_id
        ) {
            try { 
                $old_primary_name = $this->area_name_repository->findPrimaryByAreaId(
                    $area_id
                );

                if($old_primary_name !== null) {
                    $this->area_name_repository->updatePrimary(
                        $old_primary_name->record_id,
                        false
                    );
                }

                $this->area_name_repository->updatePrimary(
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