<?php 
namespace WarehouseCore\Service\Movement;

use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Payload\Result\ServiceResult;

class MoveContainerService {
    public function __construct(
        private LocationRepository $Location,
        private ContainerPlacementRepository $ContainerPlacement,
        private ContainerRepository $Container
    ) {}

    public function execute(int $ContainerId, int $LocationId): ServiceResult {
        try {
            $ContainerEntity = $this->Container->findById($ContainerId);
            if($ContainerEntity === null)
                return new ServiceResult(false, null, "Контейнер $ContainerId не найден");

            $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
            if($ContainerPlacementEntity === null)
                return new ServiceResult(false, null, "Контейнер $ContainerId не размещен");

            $NewLocationEntity = $this->Location->findById($LocationId);
            if($NewLocationEntity === null)
                return new ServiceResult(false, null, "Локация $LocationId не существует");

            $this->ContainerPlacement->updateLocationId($ContainerPlacementEntity['Id'], $LocationId);
            return new ServiceResult(true, ['containerId'=>$ContainerId,'locationId'=>$LocationId], null);
        } catch(\RuntimeException $e) {
            return new ServiceResult(false, null, $e->getMessage());
        }
    }
}