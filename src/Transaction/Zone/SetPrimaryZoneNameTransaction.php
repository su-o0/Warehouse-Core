<?php
namespace WarehouseCore\Transaction\Zone;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\ZoneNameRepository;

final class SetPrimaryZoneNameTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private ZoneNameRepository $zone_name_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $record_id,
        int $zone_id
    ): mixed{
        return $this->run(function () use (
            $record_id,
            $zone_id
        ) {
            try { 
                $old_primary_name = $this->zone_name_repository->findPrimaryByZoneId(
                    $zone_id
                );

                if($old_primary_name !== null) {
                    $this->zone_name_repository->updatePrimary(
                        $old_primary_name->record_id,
                        false
                    );
                }

                $this->zone_name_repository->updatePrimary(
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