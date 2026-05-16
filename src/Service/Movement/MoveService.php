<?php 
namespace SuO0\StorageApi\Service\Movement;

use SuO0\StorageApi\Repository\Topology\LocationRepository;
use SuO0\StorageApi\Repository\Topology\ItemPlacementRepository;
use SuO0\StorageApi\Repository\Topology\StockPlacementRepository;

class MoveService {
    public function __construct(
        private LocationRepository $Location,
        private ItemPlacementRepository $ItemPlacement,
        private StockPlacementRepository $StockPlacement,
    ) {}

    public function execute(string $EntityType, int $EntityId, int $LocationId): void {

        switch($EntityType) {
            case 'Item':
                $ItemPlacementEntity = $this->ItemPlacement->findByItemId($EntityId);
                if($ItemPlacementEntity === null)
                    throw new \RuntimeException("Предмет $EntityId не размещен");

                $NewLocationEntity = $this->Location->findById($LocationId);
                if($NewLocationEntity === null)
                    throw new \RuntimeException("Локация $LocationId не существует");

                $this->ItemPlacement->updateLocationId($ItemPlacementEntity['Id'], $LocationId);
                echo "Предмет $EntityId успешно перемещен в локацию $LocationId\n";
                break;
            case 'Stock':
                $StockPlacementEntity = $this->StockPlacement->findByStockId($EntityId);
                if($StockPlacementEntity === null)
                    throw new \RuntimeException("Сток $EntityId не размещен");

                $NewLocationEntity = $this->Location->findById($LocationId);
                if($NewLocationEntity === null)
                    throw new \RuntimeException("Локация $LocationId не существует");

                $this->StockPlacement->updateLocationId($StockPlacementEntity['Id'], $LocationId);
                echo "Сток $EntityId успешно перемещен в локацию $LocationId\n";
                break;
            default:
                throw new \RuntimeException("Невозможно переместить сущность типа $EntityType");
        }
    }
}