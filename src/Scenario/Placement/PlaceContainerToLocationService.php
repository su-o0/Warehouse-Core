<?php 
namespace SuO0\StorageApi\Service\Placement;

use SuO0\StorageApi\Repository\Topology\LocationRepository;
use SuO0\StorageApi\Repository\Topology\ContainerPlacementRepository;
use SuO0\StorageApi\Repository\Inventory\ContainerRepository;

class PlaceContainerToLocationService {
    public function __Construct(
        private LocationRepository $Location,
        private ContainerPlacementRepository $ContainerPlacement,
        private ContainerRepository $Container
    ) { }

    public function execute(int $ContainerId, int $LocationId): void {
        echo "Размещение контейнера $ContainerId в локацию $LocationId\n";      

        $LocationEntity = $this->Location->findById($LocationId);
        if($LocationEntity === null)
            throw new \RuntimeException("Локация $LocationId не существует");

        $ContainerEntity = $this->Container->findById($ContainerId);
        if($ContainerEntity === null)
            throw new \RuntimeException("Контейнер $ContainerId не существует");
        $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
        if($ContainerPlacementEntity !== null)
            throw new \RuntimeException("Контейнер $ContainerId уже размещен");

        $this->ContainerPlacement->add($LocationId, $ContainerId);  
        echo "Контейнер $ContainerId успешно размещен в локацию $LocationId\n";
    }
}   