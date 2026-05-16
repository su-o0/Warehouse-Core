<?php 
namespace StorageApi\Service\Movement;

use StorageApi\Repository\Topology\ContainerPlacementRepository;
use StorageApi\Repository\Topology\ItemPlacementRepository;
use StorageApi\Repository\Topology\StockPlacementRepository;
use StorageApi\Repository\Inventory\ItemRepository;
use StorageApi\Repository\Inventory\StockRepository;

class RemoveFromContainerService {
    public function __construct(
        private ContainerPlacementRepository $ContainerPlacement,
        private ItemPlacementRepository $ItemPlacement,
        private StockPlacementRepository $StockPlacement,
        private ItemRepository $Item,
        private StockRepository $Stock
    ) {}

    public function execute(string $EntityType, int $EntityId): void {
        switch($EntityType) {
            case 'Item':
                $ItemPlacementEntity = $this->ItemPlacement->findByItemId($EntityId);
                if($ItemPlacementEntity === null)
                    throw new \RuntimeException("Предмет $EntityId не размещен");

                $ContainerPlacementEntity = $this->ContainerPlacement->findById($ItemPlacementEntity['ContainerPlacementId']);
                if($ContainerPlacementEntity === null)
                    throw new \RuntimeException("Контейнер для предмета $EntityId не найден");

                $this->ItemPlacement->delete($ItemPlacementEntity['Id']);
                $this->Item->updateContainerId($EntityId);
                echo "Предмет $EntityId успешно удален из контейнера\n";
                break;
            case 'Stock':
                $StockPlacementEntity = $this->StockPlacement->findByStockId($EntityId);
                if($StockPlacementEntity === null)
                    throw new \RuntimeException("Сток $EntityId не размещен");

                $ContainerPlacementEntity = $this->ContainerPlacement->findById($StockPlacementEntity['ContainerPlacementId']);
                if($ContainerPlacementEntity === null)
                    throw new \RuntimeException("Контейнер для стока $EntityId не найден");
                    
                $this->StockPlacement->delete($StockPlacementEntity['Id']);
                $this->Stock->updateContainerId($EntityId);
                echo "Сток $EntityId успешно удален из контейнера\n";
                break;
            default:
                throw new \RuntimeException("Невозможно удалить сущность типа $EntityType из контейнера");
        }
    }
}