<?php
namespace WarehouseCore\Transaction\Rack;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Enum\RackTypeEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Topology\ShelfRepository;
use WarehouseCore\Repository\Processing\RackProcessingStepRepository;
use WarehouseCore\Repository\Topology\StorageSlotRepository;

final class PopulateRackTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private RackRepository $rack_repository,
        private ShelfRepository $shelf_repository,
        private StorageSlotRepository $storage_slot_repository,
        private RackProcessingStepRepository $rack_processing_step_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        RackEntity $rack,
        int $count,
        int $user_id,
    ): mixed{
        return $this->run(function () use (
            $rack,
            $count,
            $user_id
        ) {
            $this->rack_processing_step_repository->add(
                rack_id: $rack->id,
                stage: RackProcessingStepStageEnum::Populate->value,
            );

            $this->rack_repository->updateStatus(
                id: $user_id,
                status: RackStatusEnum::Processing->value
            );

            if ($rack->type === RackTypeEnum::Shelf) {
                for($i = 1; $i <= $count; $i++) {
                    $this->shelf_repository->add(
                        rack_id: $rack->id,
                        shelf_level: $i,
                        user_id: $user_id
                    );
                }
            }

            if ($rack->type === RackTypeEnum::StorageSlot) {
                for($i = 1; $i <= $count; $i++) {
                    $this->storage_slot_repository->add(
                        rack_id: $rack->id,
                        slot_position: $i,
                        user_id: $user_id
                    );
                }
            }

            return ServiceResult::success();
        });
    }
}