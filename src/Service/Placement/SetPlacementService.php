<?php
namespace WarehouseCore\Service\Placement;

use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Topology\PhysicalTagRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;

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

    public function execute(string $EntityType, int $EntityId, int $LocationId): void {
        switch($EntityType) {
            case 'Item':
                if($LocationId === null)
                    throw new \RuntimeException("Для размещения предмета необходимо указать Id контейнера");    
                $ContainerId = $LocationId;
                $PhysicalTagId = $EntityId;

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
                echo "Товар $EntityId успешно размещен в контейнер $ContainerId\n";
                break;
            case 'Stock':
                if($LocationId === null)
                    throw new \RuntimeException("Для размещения стока необходимо указать Id контейнера");   

                $ContainerId = $LocationId;
                $StockId = $EntityId;
                $StockEntity = $this->Stock->findById($StockId);
                if($StockEntity === null)
                    throw new \RuntimeException("Сток $StockId не найден");

                $StockPlacementEntity = $this->StockPlacement->findByStockId($StockId);
                if($StockPlacementEntity === null)
                    throw new \RuntimeException("Сток $StockId не размещен");
                
                $ContainerEntity = $this->Container->findById($ContainerId);
                if($ContainerEntity === null)
                    throw new \RuntimeException("Контейнер $ContainerId не найден");

                $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
                if($ContainerPlacementEntity === null)
                    throw new \RuntimeException("Контейнер $ContainerId не размещен");

                
                $this->StockPlacement->delete($StockPlacementEntity['Id']);
                $this->Stock->updateContainerId($StockEntity['Id'], $ContainerId);
                echo "Сток $EntityId успешно размещен в контейнер $ContainerId\n";
                break;
            case 'Container':
                if($LocationId === null)
                    throw new \RuntimeException("Для размещения стока необходимо указать Id контейнера");   

                $ContainerId = $EntityId;

                $LocationEntity = $this->Location->findById($LocationId);
                if($LocationEntity === null)
                    throw new \RuntimeException("Локации не существует");

                $ContainerEntity = $this->Container->findById($ContainerId);
                if($ContainerEntity === null)
                    throw new \RuntimeException("Контейнер $ContainerId не существует");
                $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
                if($ContainerPlacementEntity !== null)
                    throw new \RuntimeException("Контейнер $ContainerId уже размещен");

                $this->ContainerPlacement->add($LocationEntity['Id'], $ContainerId);  
                echo "Контейнер $ContainerId успешно размещен в локацию ".$LocationEntity['Address']."\n";
        
                break;
            default:
                throw new \RuntimeException("Неподдерживаемый тип сущности: $EntityType");
        }
    }
}
