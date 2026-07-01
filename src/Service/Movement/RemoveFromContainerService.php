<?php 
namespace WarehouseCore\Service\Movement;

use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Payload\Result\ServiceResult;

class RemoveFromContainerService {
    public function __construct(
        private ContainerPlacementRepository $ContainerPlacement,
        private ItemPlacementRepository $ItemPlacement,
        private StockPlacementRepository $StockPlacement,
        private ItemRepository $Item,
        private StockRepository $Stock
    ) {}

    public function execute(string $EntityType, int $EntityId): ServiceResult {
        try {
            switch($EntityType) {
                case 'Item':
                    $ItemPlacementEntity = $this->ItemPlacement->findByItemId($EntityId);
                    if($ItemPlacementEntity === null)
                        return new ServiceResult(false, null, "Предмет $EntityId не размещен");

                    $ContainerPlacementEntity = $this->ContainerPlacement->findById($ItemPlacementEntity['ContainerPlacementId']);
                    if($ContainerPlacementEntity === null)
                        return new ServiceResult(false, null, "Контейнер для предмета $EntityId не найден");

                    $this->ItemPlacement->delete($ItemPlacementEntity['Id']);
                    $this->Item->updateContainerId($EntityId);
                    return new ServiceResult(true, ['type'=>'Item','id'=>$EntityId], null);

                case 'Stock':
                    $StockPlacementEntity = $this->StockPlacement->findByStockId($EntityId);
                    if($StockPlacementEntity === null)
                        return new ServiceResult(false, null, "Сток $EntityId не размещен");

                    $ContainerPlacementEntity = $this->ContainerPlacement->findById($StockPlacementEntity['ContainerPlacementId']);
                    if($ContainerPlacementEntity === null)
                        return new ServiceResult(false, null, "Контейнер для стока $EntityId не найден");

                    $this->StockPlacement->delete($StockPlacementEntity['Id']);
                    $this->Stock->updateContainerId($EntityId);
                    return new ServiceResult(true, ['type'=>'Stock','id'=>$EntityId], null);

                default:
                    return new ServiceResult(false, null, "Невозможно удалить сущность типа $EntityType из контейнера");
            }
        } catch(\RuntimeException $e) {
            return new ServiceResult(false, null, $e->getMessage());
        }
    }
}