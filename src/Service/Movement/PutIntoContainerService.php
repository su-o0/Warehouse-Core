<?php
namespace StorageApi\Service\Movement;
use StorageApi\Repository\Topology\LocationRepository;
use StorageApi\Repository\Topology\ContainerPlacementRepository;
use StorageApi\Repository\Inventory\ContainerRepository;
use StorageApi\Service\Placement\SetPlacementService;  

class PutIntoContainerService {
    public function __construct(
        private LocationRepository $Location,
        private ContainerPlacementRepository $ContainerPlacement,
        private ContainerRepository $Container,
        private SetPlacementService $SetPlacement
    ) {}

    public function execute(string $EntityType, int $EntityId, int $ContainerId): void {
        switch($EntityType) {
            case 'Item':
                $this->SetPlacement->execute('Item', $EntityId, $ContainerId);
                break;
            case 'Stock':
                $this->SetPlacement->execute('Stock', $EntityId, $ContainerId);
                break;
            default:
                throw new \RuntimeException("Невозможно поместить сущность типа $EntityType в контейнер");
        }
    }
}