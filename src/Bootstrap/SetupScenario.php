<?php
namespace SuO0\StorageApi\Bootstrap;

use SuO0\StorageApi\Scenario\AddAddressScenario;
use SuO0\StorageApi\Scenario\AddContainerScenario;
use SuO0\StorageApi\Scenario\AddTagScenario;
use SuO0\StorageApi\Scenario\AddItemScenario;
use SuO0\StorageApi\Scenario\AddStockScenario;

class SetupScenario {
    public AddAddressScenario $AddAddress;
    public AddContainerScenario $AddContainer;
    public AddTagScenario $AddTag;
    public AddItemScenario $AddItem;
    public AddStockScenario $AddStock;

    public function __construct(private SetupRepository $repo) {
        $this->AddAddress = new AddAddressScenario(
            $this->repo->Location
        );
        $this->AddContainer = new AddContainerScenario(
            $this->repo->Location,
            $this->repo->Container
        );
        $this->AddTag = new AddTagScenario(
            $this->repo->PhysicalTag
        );
        $this->AddItem = new AddItemScenario(
            $this->repo->Location,
            $this->repo->Container,
            $this->repo->PhysicalTag,
            $this->repo->Item,
            $this->repo->ItemPhoto,
            $this->repo->Owner
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