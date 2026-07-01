<?php
namespace WarehouseCore\Service\Placement;

use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Payload\Result\ServiceResult;

class SetPlacementService {
    public function __construct(
        private LocationRepository $Location,
        private ContainerPlacementRepository $ContainerPlacement,
        private ItemPlacementRepository $ItemPlacement,
        private StockPlacementRepository $StockPlacement,
        private PhysicalTagRepository $PhysicalTag,
        private ContainerRepository $Container,
        private ItemRepository $Item,
        private StockRepository $Stock
    ) {}

    public function execute(string $EntityType, int $EntityId, int $LocationId): ServiceResult {
        try {
            switch($EntityType) {
                case 'Item':
                    if($LocationId === null)
                        return new ServiceResult(false, null, "Для размещения предмета необходимо указать Id контейнера");
                    $ContainerId = $LocationId;
                    $PhysicalTagId = $EntityId;

                    $PhysicalTagEntity = $this->PhysicalTag->findById($PhysicalTagId);
                    if($PhysicalTagEntity === null)
                        return new ServiceResult(false, null, "Физическая метка $PhysicalTagId не существует");

                    $ItemEntities = $this->Item->findByPhysicalTagId($PhysicalTagId);
                    if(empty($ItemEntities))
                        return new ServiceResult(false, null, "Предмет $PhysicalTagId не существует");

                    $ItemEntity = $ItemEntities[0];
                    $ItemPlacementEntity = $this->ItemPlacement->findByItemId($ItemEntity['Id']);

                    $ContainerEntity = $this->Container->findById($ContainerId);
                    if($ContainerEntity === null)
                        return new ServiceResult(false, null, "Контейнер $ContainerId не существует");

                    $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
                    if($ContainerPlacementEntity === null)
                        return new ServiceResult(false, null, "Контейнер $ContainerId не размещен");

                    if($ItemPlacementEntity !== null) {
                        $this->ItemPlacement->delete($ItemPlacementEntity['Id']);
                    }
                    $this->Item->updateContainerId($ItemEntity['Id'], $ContainerId);
                    return new ServiceResult(true, ['type'=>'Item','id'=>$EntityId,'containerId'=>$ContainerId], null);

                case 'Stock':
                    if($LocationId === null)
                        return new ServiceResult(false, null, "Для размещения стока необходимо указать Id контейнера");

                    $ContainerId = $LocationId;
                    $StockId = $EntityId;
                    $StockEntity = $this->Stock->findById($StockId);
                    if($StockEntity === null)
                        return new ServiceResult(false, null, "Сток $StockId не найден");

                    $StockPlacementEntity = $this->StockPlacement->findByStockId($StockId);
                    if($StockPlacementEntity === null)
                        return new ServiceResult(false, null, "Сток $StockId не размещен");
                    
                    $ContainerEntity = $this->Container->findById($ContainerId);
                    if($ContainerEntity === null)
                        return new ServiceResult(false, null, "Контейнер $ContainerId не найден");

                    $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
                    if($ContainerPlacementEntity === null)
                        return new ServiceResult(false, null, "Контейнер $ContainerId не размещен");

                    $this->StockPlacement->delete($StockPlacementEntity['Id']);
                    $this->Stock->updateContainerId($StockEntity['Id'], $ContainerId);
                    return new ServiceResult(true, ['type'=>'Stock','id'=>$EntityId,'containerId'=>$ContainerId], null);

                case 'Container':
                    if($LocationId === null)
                        return new ServiceResult(false, null, "Для размещения стока необходимо указать Id контейнера");

                    $ContainerId = $EntityId;

                    $LocationEntity = $this->Location->findById($LocationId);
                    if($LocationEntity === null)
                        return new ServiceResult(false, null, "Локации не существует");

                    $ContainerEntity = $this->Container->findById($ContainerId);
                    if($ContainerEntity === null)
                        return new ServiceResult(false, null, "Контейнер $ContainerId не существует");
                    $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
                    if($ContainerPlacementEntity !== null)
                        return new ServiceResult(false, null, "Контейнер $ContainerId уже размещен");

                    $this->ContainerPlacement->add($LocationEntity['Id'], $ContainerId);  
                    return new ServiceResult(true, ['type'=>'Container','id'=>$ContainerId,'address'=>$LocationEntity['Address']], null);
        
                default:
                    return new ServiceResult(false, null, "Неподдерживаемый тип сущности: $EntityType");
            }
        } catch(\RuntimeException $e) {
            return new ServiceResult(false, null, $e->getMessage());
        }
    }
}
