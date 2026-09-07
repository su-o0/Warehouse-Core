<?php
namespace WarehouseCore\Transaction\Rack;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Audit\RackPlacementArchiveRepository;
use WarehouseCore\Repository\Topology\RackPlacementRepository;

final class PlaceRackToZoneTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private RackPlacementRepository $rack_placement_repository,
        private RackPlacementArchiveRepository $rack_placement_archive_repository,
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