<?php 
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\LocationRepository;
use SuO0\StorageApi\Repository\PlacementRepository;
use SuO0\StorageApi\Repository\ContainerRepository;
use SuO0\StorageApi\Repository\StockRepository;
use SuO0\StorageApi\Repository\ItemRepository;

class AddPlacementScenario {
    public function __Construct(
        private LocationRepository $Location,
        private PlacementRepository $Placement,
        private ContainerRepository $Container,
        private StockRepository $Stock,
        private ItemRepository $Item
    ) {

    }

    public function execute(int $Address, string $EntityType, int $EntityId):void {
        $Location = $this->Location->findByAddress($Address);
        if($Location === null)
            throw new \RuntimeException("Адресс $Address не существует");

        if(!$this->Placement->isStateEntityType($EntityType))
            throw new \RuntimeException("Тип сущности должен быть Container|Item|Stock");

        $findEntityId = $this->$EntityType->findById($EntityId);
        if($findEntityId === null)
            throw new \RuntimeException("Сущность $EntityType\.$EntityId не существует");
        
        $this->Placement->add($Location['Id'], $EntityType, $EntityId);
    }
}