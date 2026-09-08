<?php
namespace WarehouseCore\Transaction\Rack;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\RackNameRepository;

final class SetPrimaryRackNameTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private RackNameRepository $rack_name_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $record_id,
        int $rack_id
    ): mixed{
        return $this->run(function () use (
            $record_id,
            $rack_id
        ) {
            $old_primary_name = $this->rack_name_repository->findPrimaryByRackId(
                rack_id: $rack_id
            );

            if($old_primary_name !== null) {
                $this->rack_name_repository->updatePrimary(
                    record_id: $old_primary_name->record_id,
                    is_primary: false
                );
            }

            $this->rack_name_repository->updatePrimary(
                record_id: $record_id,
                is_primary: true
            );
            
            return ServiceResult::success();
        });
    }
}