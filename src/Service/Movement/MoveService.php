<?php 
namespace StorageApi\Service\Movement;

use StorageApi\Repository\Topology\LocationRepository;
use StorageApi\Repository\Topology\ItemPlacementRepository;
use StorageApi\Repository\Topology\StockPlacementRepository;
use StorageApi\Repository\Inventory\ItemRepository;
use StorageApi\Repository\Inventory\StockRepository;   

class MoveService {
    public function __construct(
        private LocationRepository $Location,
        private ItemPlacementRepository $ItemPlacement,
        private StockPlacementRepository $StockPlacement,
        private ItemRepository $Item,
        private StockRepository $Stock
    ) {}

    public function execute(string $EntityType, int $EntityId, string $Address): void {

        switch($EntityType) {
            case 'Item':
                $ItemEntity = $this->Item->findById($EntityId);
                if($ItemEntity === null)
                    throw new \RuntimeException("Предмет $EntityId не найден"); 

                $ItemPlacementEntity = $this->ItemPlacement->findByItemId($EntityId);
                if($ItemPlacementEntity === null)
                    throw new \RuntimeException("Предмет $EntityId не размещен");

                $LocationEntity = $this->Location->findByAddress($Address);
                if($LocationEntity === null)
                    throw new \RuntimeException("Локация $Address не существует");

                $this->ItemPlacement->updateLocationId($ItemPlacementEntity['Id'], $LocationEntity['Id']);
                echo "Элемент c биркой ". $ItemEntity['PhysicalTagId'] ." успешно перемещен в локацию $Address\n";
                break;
            case 'Stock':
                $StockEntity = $this->Stock->findById($EntityId);
                if($StockEntity === null)
                    throw new \RuntimeException("Сток $EntityId не найден");

                $StockPlacementEntity = $this->StockPlacement->findByStockId($EntityId);
                if($StockPlacementEntity === null)
                    throw new \RuntimeException("Сток $EntityId не размещен");

                $LocationEntity = $this->Location->findByAddress($Address);
                if($LocationEntity === null)
                    throw new \RuntimeException("Локация $Address не существует");

                $this->StockPlacement->updateLocationId($StockPlacementEntity['Id'], $LocationEntity['Id']);
                echo "Сток $EntityId успешно перемещен в локацию $Address\n";
                break;
            default:
                throw new \RuntimeException("Невозможно переместить сущность типа $EntityType");
        }
    }
}