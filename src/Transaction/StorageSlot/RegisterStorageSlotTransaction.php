<?php
namespace WarehouseCore\Transaction\StorageSlot;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Enum\StorageSlotStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Topology\StorageSlotRepository;

final class RegisterStorageSlotTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private StorageSlotRepository $storage_slot_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        RackEntity $rack,
        int $slot_position,
        int $user_id,
    ): mixed{
        return $this->run(function () use (
            $rack,
            $slot_position,
            $user_id
        ) {
            $id = $this->storage_slot_repository->add(
                rack_id: $rack->id,
                slot_position: $slot_position,
                user_id: $user_id
            );

            if ($rack->status === RackStatusEnum::Active) {
                $this->storage_slot_repository->updateStatus(
                    id: $id,
                    status: StorageSlotStatusEnum::Active->value
                );
            }

            return ServiceResult::success();
        });
    }
}