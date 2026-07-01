<?php 
namespace WarehouseCore\Service\Movement;

use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Payload\Result\ServiceResult;

class MoveService {
    public function __construct(
        private LocationRepository $Location,
        private ItemPlacementRepository $ItemPlacement,
        private StockPlacementRepository $StockPlacement,
        private ItemRepository $Item,
        private StockRepository $Stock
    ) {}

    public function execute(string $EntityType, int $EntityId, string $Address): ServiceResult {
        try {
            switch($EntityType) {
                case 'Item':
                    $ItemEntity = $this->Item->findById($EntityId);
                    if($ItemEntity === null)
                        return new ServiceResult(false, null, "Предмет $EntityId не найден");

                    $ItemPlacementEntity = $this->ItemPlacement->findByItemId($EntityId);
                    if($ItemPlacementEntity === null)
                        return new ServiceResult(false, null, "Предмет $EntityId не размещен");

                    $LocationEntity = $this->Location->findByAddress($Address);
                    if($LocationEntity === null)
                        return new ServiceResult(false, null, "Локация $Address не существует");

                    $this->ItemPlacement->updateLocationId($ItemPlacementEntity['Id'], $LocationEntity['Id']);
                    return new ServiceResult(true, ['type'=>'Item','id'=>$EntityId,'address'=>$Address], null);

                case 'Stock':
                    $StockEntity = $this->Stock->findById($EntityId);
                    if($StockEntity === null)
                        return new ServiceResult(false, null, "Сток $EntityId не найден");

                    $StockPlacementEntity = $this->StockPlacement->findByStockId($EntityId);
                    if($StockPlacementEntity === null)
                        return new ServiceResult(false, null, "Сток $EntityId не размещен");

                    $LocationEntity = $this->Location->findByAddress($Address);
                    if($LocationEntity === null)
                        return new ServiceResult(false, null, "Локация $Address не существует");

                    $this->StockPlacement->updateLocationId($StockPlacementEntity['Id'], $LocationEntity['Id']);
                    return new ServiceResult(true, ['type'=>'Stock','id'=>$EntityId,'address'=>$Address], null);

                default:
                    return new ServiceResult(false, null, "Невозможно переместить сущность типа $EntityType");
            }
        } catch(\RuntimeException $e) {
            return new ServiceResult(false, null, $e->getMessage());
        }
    }
}