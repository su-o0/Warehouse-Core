<?php 
namespace SuO0\StorageApi\Service\Placement;

use SuO0\StorageApi\Repository\Topology\ContainerPlacementRepository;
use SuO0\StorageApi\Repository\Topology\ItemPlacementRepository;
use SuO0\StorageApi\Repository\Topology\PhysicalTagRepository;
use SuO0\StorageApi\Repository\Inventory\ItemRepository;
use SuO0\StorageApi\Repository\Inventory\ContainerRepository;

class PlaceItemToContainerService {
    public function __Construct(
        private ContainerPlacementRepository $ContainerPlacement,
        private ItemPlacementRepository $ItemPlacement,
        private PhysicalTagRepository $PhysicalTag,
        private ItemRepository $Item,
        private ContainerRepository $Container
    ) { }

    public function execute(string $PhysicalTagId, int $ContainerId): void {
        echo "Размещение предмета $PhysicalTagId в контейнер $ContainerId\n";
        $PhysicalTagEntity = $this->PhysicalTag->findById($PhysicalTagId);
        if($PhysicalTagEntity === null)
            throw new \RuntimeException("Физическая метка $PhysicalTagId не существует");

        $ItemEntity = $this->Item->findByPhysicalTagIdStatus($PhysicalTagId, 'Active');
        if($ItemEntity === null)
            throw new \RuntimeException("Предмет $PhysicalTagId не существует");
        
        $ItemPlacementEntity = $this->ItemPlacement->findByItemId($ItemEntity[0]['Id']);
        if($ItemPlacementEntity === null) 
            throw new \RuntimeException("Предмет $PhysicalTagId уже размещен");

        $ContainerEntity = $this->Container->findById($ContainerId);
        if($ContainerEntity === null)
            throw new \RuntimeException("Контейнер $ContainerId не существует");

        $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
        if($ContainerPlacementEntity === null)
            throw new \RuntimeException("Контейнер $ContainerId не размещен");

        $this->ItemPlacement->delete($ItemPlacementEntity['Id']);
        $this->Item->updateContainerId($ItemEntity[0]['Id'], $ContainerId);
        echo "Предмет $PhysicalTagId успешно размещен в контейнер $ContainerId\n";
    }
}