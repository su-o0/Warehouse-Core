<?php
namespace WarehouseCore\Transaction\Rack;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Inventory\ShelfRepository;
use WarehouseCore\Repository\Processing\RackProcessingStepRepository;

final class PlaceRackToAreaTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private RackRepository $rack_repository,
        private ShelfRepository $shelf_repository,
        private RackProcessingStepRepository $rack_processing_step_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $rack_id,
        int $count,
        int $user_id,
        RackStatusEnum $rack_status
    ): mixed{
        return $this->run(function () use (
            $rack_id,
            $count,
            $user_id,
            $rack_status
        ) {
            $this->rack_processing_step_repository->add(
                rack_id: $rack_id,
                stage: RackProcessingStepStageEnum::Populate->value,
            );
            
            for($i = 1; $i <= $count; $i++) {
                $this->shelf_repository->add(
                    rack_id: $rack_id,
                    rack_level_id: $i,
                    user_id: $user_id
                );
            }
            
            if ($rack_status === RackStatusEnum::Registered) {
                $this->rack_repository->updateStatus(
                    id: $user_id,
                    status: RackStatusEnum::Processing->value
                );
            }

            return new ServiceResult(
                success: true
            );
        });
    }
}