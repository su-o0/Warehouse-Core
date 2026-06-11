<?php
namespace WarehouseCore\Registry;
use WarehouseCore\Service\Identity\AuthenticationService;
use WarehouseCore\Service\Setup\AddLocationService;
use WarehouseCore\Service\Setup\AddContainerService;
use WarehouseCore\Service\Setup\AddPhysicalTagService;
use WarehouseCore\Service\Setup\AddUserService;
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

use WarehouseCore\Service\Media\AddPhotoService;
use WarehouseCore\Service\Media\DeletePhotoService;

use WarehouseCore\Service\Audit\SetOwnerPermisitionService;
use WarehouseCore\Service\Audit\GetAllOwnerService;
use WarehouseCore\Service\Audit\GetOwnerService;
use WarehouseCore\Service\Audit\DeleteOwnerService;
use WarehouseCore\Service\Audit\GetHistoryService;
use WarehouseCore\Service\Audit\GetSalesService;


final class ServiceRegistry {
    private AuthenticationService $authentication; 
    private AddLocationService $AddLocation;
    private AddContainerService $AddContainer;
    private AddPhysicalTagService $AddPhysicalTag;
    private AddUserService $AddUser;
    private AddOwnerService $AddOwner;
    private AddCarService $AddCar;
    private AddItemService $AddItem;
    private AddStockService $AddStock;
    private SetPlacementService $SetPlacement;
    private MoveService $Move;
    private MoveContainerService $MoveContainer;
    private PutIntoContainerService $PutIntoContainer;
    private RemoveFromContainerService $RemoveFromContainer;
    private IncrementStockQtyService $IncrementStockQty;
    private DecrementStockQtyService $DecrementStockQty;
    private DeleteStockService $DeleteStock;
    private SetItemConditionService $SetItemCondition;
    private MarkItemSoldService $MarkItemSold;
    private ArchiveItemService $ArchiveItem;
    private ReturnItemService $ReturnItem;
    private GetAllCarService $GetAllCar;
    private GetAllLocationService $GetAllLocation;
    private GetLocationContentService $GetLocationContent;
    private GetContainerContentService $GetContainerContent;
    private FindPhysicalTagService $FindPhysicalTag;
    private FindStockService $FindStock;
    private FindByTagService $FindByTag;
    private AddPhotoService $AddPhoto;
    private DeletePhotoService $DeletePhoto;
    private SetOwnerPermisitionService $SetOwnerPermisition;
    private GetAllOwnerService $GetAllOwner;
    private GetOwnerService $GetOwner;
    private DeleteOwnerService $DeleteOwner;
    private GetHistoryService $GetHistory;
    private GetSalesService $GetSales;

    public function __construct(
        private RepositoryRegistry $repository, 
    ) {
    //     $this->SetPlacement = new SetPlacementService(
    //         $repo->Location, 
    //         $repo->ContainerPlacement, 
    //         $repo->ItemPlacement, 
    //         $repo->StockPlacement, 
    //         $repo->PhysicalTag,
    //         $repo->Container, 
    //         $repo->Item, 
    //         $repo->Stock
    //     );
    //     $this->Move = new MoveService(
    //         $repo->Location, 
    //         $repo->ItemPlacement, 
    //         $repo->StockPlacement, 
    //         $repo->Item, 
    //         $repo->Stock
    //     );
    //     $this->MoveContainer = new MoveContainerService(
    //         $repo->Location, 
    //         $repo->ContainerPlacement, 
    //         $repo->Container
    //     );
    //     $this->PutIntoContainer = new PutIntoContainerService(
    //         $SetPlacement
    //     );
    //     $this->RemoveFromContainer = new RemoveFromContainerService(
    //         $repo->ContainerPlacement, 
    //         $repo->ItemPlacement, 
    //         $repo->StockPlacement, 
    //         $repo->Item, 
    //         $repo->Stock
    //     );
    //     $this->IncrementStockQty = new IncrementStockQtyService(
    //         $repo->Stock
    //     );
    //     $this->DecrementStockQty = new DecrementStockQtyService(
    //         $repo->Stock
    //         );
    //     $this->DeleteStock = new DeleteStockService(
    //         $this->repo->Stock
    //     );
    //     $this->SetItemCondition = new SetItemConditionService(
    //         $this->repo->Item
    //     );
    //     $this->MarkItemSold = new MarkItemSoldService();
    //     $this->ArchiveItem          = new ArchiveItemService();
    //     $this->ReturnItem           = new ReturnItemService();
    //     $this->GetAllCar            = new GetAllCarService();
    //     $this->GetAllLocation       = new GetAllLocationService($this->repo->Location);
    //     $this->GetLocationContent   = new GetLocationContentService($this->repo->Location, $this->repo->ContainerPlacement, $this->repo->ItemPlacement, $this->repo->StockPlacement, $this->repo->Item, $this->repo->Stock, $this->repo->Part);
    //     $this->FindPhysicalTag      = new FindPhysicalTagService();
    //     $this->FindStock            = new FindStockService();
    //     $this->FindByTag            = new FindByTagService();

    //     $this->AddPhoto = new AddPhotoService();
    //     $this->DeletePhoto = new DeletePhotoService();
    //     $this->SetOwnerPermisition = new SetOwnerPermisitionService();
    //     $this->GetAllOwner = new GetAllOwnerService($this->repo->Owner);
    //     $this->GetOwner             = new GetOwnerService($this->repo->Owner);
    //     $this->DeleteOwner = new DeleteOwnerService();
    //     $this->GetHistory = new GetHistoryService();
    //     $this->GetSales = new GetSalesService();
    }

    public function authentication(): AuthenticationService {
        return new AuthenticationService(
            $this->repository->user
        );
    }


    public function addUser(): AddUserService {
       return new AddUserService(
            $this->repository->user
        );
    }

    public function addOwner(): AddOwnerService {
       return new AddOwnerService(
            $this->repository->user,
            $this->repository->owner
        );
    }

    public function addLocation(): AddLocationService {
        return new AddLocationService(
            $this->repository->location
        );
    }

    public function addContainer(): AddContainerService {
        return new AddContainerService(
            $this->repository->container
        );
    }

    public function addPhysicalTag(): AddPhysicalTagService {
        return new AddPhysicalTagService(
            $this->repository->physical_tag
        );
    }

    public function addItem(): AddItemService {
        return new AddItemService(
            $this->repository->location,
            $this->repository->item_placement,
            $this->repository->physical_tag,
            $this->repository->item,
            $this->repository->part,
            $this->repository->vehicle
        );
    }

    public function addStock(): AddStockService {
        return new AddStockService(
            $this->repository->location,
            $this->repository->stock_placement,
            $this->repository->stock,
            $this->repository->part,
        );
    }

}