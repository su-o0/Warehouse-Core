<?php
namespace WarehouseCore\Transaction\Rack;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\RackNameRepository;

final class AddRackNameTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private RackNameRepository $rack_name_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $rack_id,
        string $value,
        int $user_id
    ): mixed{
        return $this->run(function () use (
            $rack_id,
            $value,
            $user_id
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

            $this->rack_name_repository->add(
                rack_id: $rack_id,
                value: $value,
                is_primary: true,
                user_id: $user_id
            );

            return ServiceResult::success();
        });
    }
}