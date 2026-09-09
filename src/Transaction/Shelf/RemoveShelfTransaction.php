<?php
namespace WarehouseCore\Transaction\Shelf;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Entity\ShelfEntity;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Processing\RackProcessingStepRepository;
use WarehouseCore\Repository\Topology\ShelfRepository;

final class RemoveShelfTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private RackRepository $rack_repository,
        private RackProcessingStepRepository $rack_processing_step_repository,
        private ShelfRepository $shelf_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        RackEntity $rack,
        ShelfEntity $shelf
    ): mixed{
        return $this->run(function () use (
            $rack,
            $shelf
        ) {
            $count = $this->shelf_repository->countByRackId(
                $rack->id
            );
            
            $this->shelf_repository->delete(
                id: $shelf->id
            );

            if ($count === 1) {
                $this->rack_repository->updateStatus(
                    id: $rack->id,
                    status: RackStatusEnum::Registered->value
                );

                $result = $this->rack_processing_step_repository->findByRackIdAndStage(
                    rack_id: $rack->id,
                    stage: RackProcessingStepStageEnum::Populate->value
                );

                $this->rack_processing_step_repository->delete(
                    record_id: $result->record_id
                );
            }

            return ServiceResult::success();
        });
    }
}