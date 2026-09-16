<?php
namespace WarehouseCore\Transaction\Zone;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Enum\ZoneProcessingStepStageEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Audit\ZonePlacementArchiveRepository;
use WarehouseCore\Repository\Processing\ZoneProcessingStepRepository;
use WarehouseCore\Repository\Topology\ZonePlacementRepository;

final class PlaceZoneToAreaTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private ZonePlacementRepository $zone_placement_repository,
        private ZonePlacementArchiveRepository $zone_placement_archive_repository,
        private ZoneProcessingStepRepository $zone_processing_step_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $zone_id,
        int $area_id,
        int $user_id
    ): mixed{
        return $this->run(function () use (
            $zone_id,
            $area_id,
            $user_id
        ) {
            $this->zone_placement_repository->add(
                $zone_id,
                $area_id
            );

            $this->zone_processing_step_repository->add(
                $zone_id,
                ZoneProcessingStepStageEnum::Placed->value
            );

            $this->zone_placement_archive_repository->add(
                $zone_id,
                $area_id,
                $user_id
            );

            return ServiceResult::success();
        });
    }
}