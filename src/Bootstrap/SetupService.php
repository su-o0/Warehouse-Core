<?php
namespace StorageApi\Bootstrap;
use StorageApi\Service\Setup\AddLocationService;
use StorageApi\Service\Setup\AddContainerService;
use StorageApi\Service\Setup\AddPhysicalTagService;
use StorageApi\Service\Setup\AddItemService;
use StorageApi\Service\Setup\AddStockService;
use StorageApi\Service\Query\GetAllLocationService;
use StorageApi\Service\Query\GetLocationContentService;
use StorageApi\Service\Placement\SetPlacementService;
use StorageApi\Service\Movement\MoveService;
use StorageApi\Service\Movement\MoveContainerService;
use StorageApi\Service\Movement\PutIntoContainerService;
use StorageApi\Service\Movement\RemoveFromContainerService;


class SetupService {
    public AddLocationService $AddLocation;
    public AddContainerService $AddContainer;
    public AddPhysicalTagService $AddPhysicalTag;
    public AddItemService $AddItem;
    public AddStockService $AddStock;

    public SetPlacementService $SetPlacement;

    public MoveService $Move;
    public MoveContainerService $MoveContainer;
    public PutIntoContainerService $PutIntoContainer;
    public RemoveFromContainerService $RemoveFromContainer;

    public GetAllLocationService $GetAllLocation;
    public GetLocationContentService $GetLocationContent;


    public function __construct(private SetupRepository $repo) {
        $this->AddLocation = new AddLocationService(
            $this->repo->Location
        );
        $this->AddContainer = new AddContainerService(
            $this->repo->Container
        );
        $this->AddPhysicalTag = new AddPhysicalTagService(
            $this->repo->PhysicalTag
        );
        $this->AddItem = new AddItemService(
            $this->repo->Location,
            $this->repo->ItemPlacement,
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

        $this->SetPlacement = new SetPlacementService(
            $this->repo->Location,
            $this->repo->ContainerPlacement,
            $this->repo->ItemPlacement,
            $this->repo->StockPlacement,
            $this->repo->PhysicalTag,
            $this->repo->Container,
            $this->repo->Item,
            $this->repo->Stock
        );

        $this->Move = new MoveService(
            $this->repo->Location,
            $this->repo->ItemPlacement,
            $this->repo->StockPlacement,
            $this->repo->Item,
            $this->repo->Stock
        );

        $this->MoveContainer = new MoveContainerService(
            $this->repo->Location,
            $this->repo->ContainerPlacement,
            $this->repo->Container
        );

        $this->PutIntoContainer = new PutIntoContainerService(
            $this->repo->Location,
            $this->repo->ContainerPlacement,
            $this->repo->Container,
            $this->SetPlacement
        );

        $this->RemoveFromContainer = new RemoveFromContainerService(
            $this->repo->ContainerPlacement,
            $this->repo->ItemPlacement,
            $this->repo->StockPlacement,
            $this->repo->Item,
            $this->repo->Stock
        );


        $this->GetAllLocation = new GetAllLocationService(
            $this->repo->Location
        );

        $this->GetLocationContent = new GetLocationContentService(
            $this->repo->Location,
            $this->repo->ContainerPlacement,
            $this->repo->ItemPlacement,
            $this->repo->StockPlacement,
            $this->repo->Item,
            $this->repo->Stock,
            $this->repo->Part
        );


    }
}