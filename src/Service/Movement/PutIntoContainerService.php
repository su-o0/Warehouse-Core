<?php
namespace StorageApi\Service\Movement;
use StorageApi\Service\Placement\SetPlacementService;  

class PutIntoContainerService {
    public function __construct(
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