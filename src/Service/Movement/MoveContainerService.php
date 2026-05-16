<?php 
namespace StorageApi\Service\Movement;

use StorageApi\Repository\Topology\LocationRepository;
use StorageApi\Repository\Topology\ContainerPlacementRepository;
use StorageApi\Repository\Inventory\ContainerRepository;

class MoveContainerService {
    public function __construct(
        private LocationRepository $Location,
        private ContainerPlacementRepository $ContainerPlacement,
        private ContainerRepository $Container
    ) {}

    public function execute(int $ContainerId, int $LocationId): void {
        $ContainerEntity = $this->Container->findById($ContainerId);
        if($ContainerEntity === null)
            throw new \RuntimeException("Контейнер $ContainerId не найден");

        $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
        if($ContainerPlacementEntity === null)
            throw new \RuntimeException("Контейнер $ContainerId не размещен");

        $NewLocationEntity = $this->Location->findById($LocationId);
        if($NewLocationEntity === null)
            throw new \RuntimeException("Локация $LocationId не существует");

        $this->ContainerPlacement->updateLocationId($ContainerPlacementEntity['Id'], $LocationId);
        echo "Контейнер $ContainerId успешно перемещен в локацию $LocationId\n";
    }
}