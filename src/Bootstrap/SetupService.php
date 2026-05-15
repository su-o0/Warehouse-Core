<?php
namespace SuO0\StorageApi\Bootstrap;

use SuO0\StorageApi\Service\Setup\AddAddressService;
use SuO0\StorageApi\Service\Setup\AddContainerService;
use SuO0\StorageApi\Service\Setup\AddPhysicalTagService;
use SuO0\StorageApi\Service\Setup\AddItemService;
use SuO0\StorageApi\Service\Setup\AddStockService;

use SuO0\StorageApi\Service\Query\GetAddressContentService;

use SuO0\StorageApi\Service\Placement\PlaceContainerToLocationService;
use SuO0\StorageApi\Service\Placement\PlaceItemToContainerService;
use SuO0\StorageApi\Service\Placement\PlaceStockToContainerService;

class SetupService {
    public AddAddressService $AddAddress;
    public AddContainerService $AddContainer;
    public AddPhysicalTagService $AddPhysicalTag;
    public AddItemService $AddItem;
    public AddStockService $AddStock;

    public GetAddressContentService $GetAddressContent;

    public PlaceContainerToLocationService $PlaceContainerToLocation;
    public PlaceItemToContainerService $PlaceItemToContainer;
    public PlaceStockToContainerService $PlaceStockToContainer;

    public function __construct(private SetupRepository $repo) {
        $this->AddAddress = new AddAddressService(
            $this->repo->Location
        );
        $this->AddContainer = new AddContainerService(
            $this->repo->Container
        );
        $this->AddPhysicalTag = new AddPhysicalTagService(
            $this->repo->PhysicalTag
        );
        $this->AddItem = new AddItemService(
            $this->repo->PhysicalTag,
            $this->repo->Item,
            $this->repo->Part,
            $this->repo->Car
        );
        $this->AddStock = new AddStockService(
            $this->repo->Location,
            $this->repo->StockPlacement,
            $this->repo->Stock,
            $this->repo->Part,
        );


        $this->GetAddressContent = new GetAddressContentService(
            $this->repo->Location,
            $this->repo->ContainerPlacement,
            $this->repo->ItemPlacement,
            $this->repo->StockPlacement,
            $this->repo->Item,
            $this->repo->Stock,
            $this->repo->Part
        );

        $this->PlaceContainerToLocation = new PlaceContainerToLocationService(
            $this->repo->Location,
            $this->repo->ContainerPlacement,
            $this->repo->Container
        );

        $this->PlaceItemToContainer = new PlaceItemToContainerService(
            $this->repo->ContainerPlacement,
            $this->repo->ItemPlacement,
            $this->repo->PhysicalTag,
            $this->repo->Item,
            $this->repo->Container
        );

        $this->PlaceStockToContainer = new PlaceStockToContainerService(
            $this->repo->ContainerPlacement,
            $this->repo->StockPlacement,
            $this->repo->Container,
            $this->repo->Stock
        );
    }
}