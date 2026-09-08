<?php
namespace WarehouseCore\Transaction\Rack;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Enum\RackTypeEnum;
use WarehouseCore\Payload\Enum\ShelfStatusEnum;
use WarehouseCore\Payload\Enum\StorageSlotStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Topology\ShelfRepository;
use WarehouseCore\Repository\Topology\StorageSlotRepository;

final class ArchiveRackTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private RackRepository $rack_repository,
        private ShelfRepository $shelf_repository,
        private StorageSlotRepository $storage_slot_repository,
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        RackEntity $rack
    ): mixed{
        return $this->run(function () use (
            $rack
        ) {
            $this->rack_repository->updateStatus(
                id: $rack->id,
                status: RackStatusEnum::Archived->value
            );

            if ($rack->type === RackTypeEnum::Shelf) {
                $shelfs = $this->shelf_repository->findByRackId(
                    rack_id: $rack->id
                );

                foreach ($shelfs as $shelf) {
                    $this->shelf_repository->updateStatus(
                        id: $shelf->id,
                        status: ShelfStatusEnum::Archived->value
                    );
                }
            }

            if ($rack->type === RackTypeEnum::StorageSlot) {
                $storage_slots = $this->storage_slot_repository->findByRackId(
                    rack_id: $rack->id
                );

                foreach ($storage_slots as $storage_slot) {
                    $this->storage_slot_repository->updateStatus(
                        id: $storage_slot->id,
                        status: StorageSlotStatusEnum::Archived->value
                    );
                }
            }

            return ServiceResult::success();
        });
    }
}