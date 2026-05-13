<?php
namespace SuO0\StorageApi\Bootstrap;

use SuO0\StorageApi\Scenario\AddAddressScenario;
use SuO0\StorageApi\Scenario\AddContainerScenario;
use SuO0\StorageApi\Scenario\AddPhysicalTagScenario;
use SuO0\StorageApi\Scenario\AddItemScenario;
use SuO0\StorageApi\Scenario\AddPlacementScenario;
use SuO0\StorageApi\Scenario\AddStockScenario;

class SetupScenario {
    public AddAddressScenario $AddAddress;
    public AddContainerScenario $AddContainer;
    public AddPhysicalTagScenario $AddPhysicalTag;
    public AddItemScenario $AddItem;
    public AddStockScenario $AddStock;
    public AddPlacementScenario $AddPlacement;

    public function __construct(private SetupRepository $repo) {
        $this->AddAddress = new AddAddressScenario(
            $this->repo->Location
        );
        $this->AddContainer = new AddContainerScenario(
            $this->repo->Container
        );
        $this->AddPhysicalTag = new AddPhysicalTagScenario(
            $this->repo->PhysicalTag
        );

        $this->AddPlacement = new AddPlacementScenario(
            $this->repo->Location,
            $this->repo->Placement,
            $this->repo->Container,
            $this->repo->Stock,
            $this->repo->Item
        );

        $this->AddItem = new AddItemScenario(
            $this->repo->PhysicalTag,
            $this->repo->Item,
            $this->repo->Part,
            $this->repo->Car
        );
        $this->AddStock = new AddStockScenario(
            $this->repo->Location,
            $this->repo->Container,
            $this->repo->Stock,
            $this->repo->Part,
            $this->repo->StockPhoto,
            $this->repo->Owner
        );
        

    }
}