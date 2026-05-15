<?php 
namespace SuO0\StorageApi\Service\Setup;

use SuO0\StorageApi\Repository\Topology\LocationRepository;

use SuO0\StorageApi\Repository\Topology\ContainerPlacementRepository;
use SuO0\StorageApi\Repository\Topology\ItemPlacementRepository;
use SuO0\StorageApi\Repository\Topology\StockPlacementRepository;

use SuO0\StorageApi\Repository\Inventory\ContainerRepository;
use SuO0\StorageApi\Repository\Inventory\StockRepository;
use SuO0\StorageApi\Repository\Inventory\ItemRepository;

class AddPlacementService {
    public function __Construct(
        private LocationRepository $Location,
        private ContainerPlacementRepository $ContainerPlacement,
        private ItemPlacementRepository $ItemPlacement,
        private StockPlacementRepository $StockPlacement,
        private ContainerRepository $Container,
        private StockRepository $Stock,
        private ItemRepository $Item
    ) {

    }

    public function execute(int $Address, string $EntityType, int $EntityId):void {
        $Location = $this->Location->findByAddress($Address);
        if($Location === null)
            throw new \RuntimeException("Адресс $Address не существует");
        
        switch($EntityType) {
            case "Container":
                $Entity = $this->Container->findById($EntityId);
                if($Entity === null)
                    throw new \RuntimeException("Контейнер $EntityId не найден"); 
                $this->ContainerPlacement->add($Address, $EntityId);
                break;
            case "Stock":
                $Entity = $this->Stock->findById($EntityId);
                if($Entity === null)               
                    throw new \RuntimeException("Сток $EntityId не найден"); 
                $this->StockPlacement->add($Address, $EntityId);
                break;
            case "Item":
                $Entity = $this->Item->findById($EntityId);
                if($Entity === null)
                    throw new \RuntimeException("Предмет $EntityId не найден");
                $this->ItemPlacement->add($Address, $EntityId);
                break;
            default:
                throw new \RuntimeException("Неверный тип сущности $EntityType");   
        }
    }
}