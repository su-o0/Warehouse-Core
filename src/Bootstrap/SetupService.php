<?php
namespace WarehouseCore\Bootstrap;
use WarehouseCore\Service\Setup\AddLocationService;
use WarehouseCore\Service\Setup\AddContainerService;
use WarehouseCore\Service\Setup\AddPhysicalTagService;
use WarehouseCore\Service\Setup\AddOwnerService;
use WarehouseCore\Service\Setup\AddCarService;
use WarehouseCore\Service\Setup\AddItemService;
use WarehouseCore\Service\Setup\AddStockService;

use WarehouseCore\Service\Placement\SetPlacementService;

use WarehouseCore\Service\Movement\MoveService;
use WarehouseCore\Service\Movement\MoveContainerService;
use WarehouseCore\Service\Movement\PutIntoContainerService;
use WarehouseCore\Service\Movement\RemoveFromContainerService;

use WarehouseCore\Service\Inventory\IncrementStockQtyService;
use WarehouseCore\Service\Inventory\DecrementStockQtyService;
use WarehouseCore\Service\Inventory\DeleteStockService;
use WarehouseCore\Service\Inventory\SetItemConditionService;
use WarehouseCore\Service\Inventory\MarkItemSoldService;
use WarehouseCore\Service\Inventory\ArchiveItemService;
use WarehouseCore\Service\Inventory\ReturnItemService;

use WarehouseCore\Service\Query\GetAllLocationService;
use WarehouseCore\Service\Query\GetAllCarService;
use WarehouseCore\Service\Query\GetLocationContentService;
use WarehouseCore\Service\Query\GetContainerContentService;
use WarehouseCore\Service\Query\FindPhysicalTagService;
use WarehouseCore\Service\Query\FindStockService;
use WarehouseCore\Service\Query\FindByTagService;

use WarehouseCore\Service\Photo\AddPhotoService;
use WarehouseCore\Service\Photo\DeletePhotoService;

use WarehouseCore\Service\Audit\SetOwnerPermisitionService;
use WarehouseCore\Service\Audit\GetAllOwnerService;
use WarehouseCore\Service\Audit\DeleteOwnerService;
use WarehouseCore\Service\Audit\GetHistoryService;
use WarehouseCore\Service\Audit\GetSalesService;


class SetupService {
    public AddLocationService $AddLocation;
    public AddContainerService $AddContainer;
    public AddPhysicalTagService $AddPhysicalTag;
    public AddOwnerService $AddOwner;
    public AddCarService $AddCar;
    public AddItemService $AddItem;
    public AddStockService $AddStock;

    public SetPlacementService $SetPlacement;

    public MoveService $Move;
    public MoveContainerService $MoveContainer;
    public PutIntoContainerService $PutIntoContainer;
    public RemoveFromContainerService $RemoveFromContainer;

    public IncrementStockQtyService $IncrementStockQty;
    public DecrementStockQtyService $DecrementStockQty;
    public DeleteStockService $DeleteStock;
    public SetItemConditionService $SetItemCondition;
    public MarkItemSoldService $MarkItemSold;
    public ArchiveItemService $ArchiveItem;
    public ReturnItemService $ReturnItem;

    public GetAllCarService $GetAllCar;
    public GetLocationContentService $GetLocationContent;
    public GetContainerContentService $GetContainerContent;
    public FindPhysicalTagService $FindPhysicalTag;
    public FindStockService $FindStock;
    public FindByTagService $FindByTag;
  

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