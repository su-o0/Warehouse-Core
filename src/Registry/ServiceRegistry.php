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
use WarehouseCore\Service\Inventory\CreateItemService;

use WarehouseCore\Service\Query\GetAllLocationService;
use WarehouseCore\Service\Query\GetAllVehicleService;
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
use WarehouseCore\Service\Setup\AddPartService;
use WarehouseCore\Service\Setup\AddVehicleService;

final class ServiceRegistry {
    public function __construct(
        private RepositoryRegistry $repository, 
    ) { }

    public function authentication(): AuthenticationService {
        return new AuthenticationService(
            $this->repository->user,
            $this->repository->user_identity
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


    public function addItem(): AddItemService {
        return new AddItemService(
            $this->repository->physical_tag,
            $this->repository->item,
            $this->repository->part,
            $this->repository->vehicle
        );
    }

    public function addStock(): AddStockService {
        return new AddStockService(
            $this->repository->stock,
            $this->repository->part,
        );
    }

    public function addPart(): AddPartService {
        return new AddPartService(
            $this->repository->part
        );
    }

    public function addVehicle():  AddVehicleService {
        return new AddVehicleService(
            $this->repository->vehicle
        );
    }

    public function getAllLocation(): GetAllLocationService {
        return new GetAllLocationService(
            $this->repository->location
        );
    }

    public function getAllVehicle(): GetAllVehicleService {
        return new GetAllVehicleService(
            $this->repository->vehicle
        );
    }

    public function getLocationContent(): GetLocationContentService {
        return new GetLocationContentService(
            $this->repository->location,
            $this->repository->container_placement,
            $this->repository->item_placement,
            $this->repository->stock_placement,
            $this->repository->item,
            $this->repository->stock,
            $this->repository->part
        );
    }

    public function getContainerContent(): GetContainerContentService {
        return new GetContainerContentService(
            $this->repository->container,
            $this->repository->item,
            $this->repository->stock,
            $this->repository->part
        );
    }

    public function findPhysicalTag(): FindPhysicalTagService {
        return new FindPhysicalTagService();
    }

    public function findStock(): FindStockService {
        return new FindStockService();
    }

    public function findByTag(): FindByTagService {
        return new FindByTagService();
    }

    public function setPlacement(): SetPlacementService {
        return new SetPlacementService(
            $this->repository->location,
            $this->repository->container_placement,
            $this->repository->item_placement,
            $this->repository->stock_placement,
            $this->repository->physical_tag,
            $this->repository->container,
            $this->repository->item,
            $this->repository->stock
        );
    }

    public function move(): MoveService {
        return new MoveService(
            $this->repository->location,
            $this->repository->item_placement,
            $this->repository->stock_placement,
            $this->repository->item,
            $this->repository->stock
        );
    }

    public function moveContainer(): MoveContainerService {
        return new MoveContainerService(
            $this->repository->location,
            $this->repository->container_placement,
            $this->repository->container
        );
    }

    public function putIntoContainer(): PutIntoContainerService {
        return new PutIntoContainerService(
            $this->setPlacement()
        );
    }

    public function removeFromContainer(): RemoveFromContainerService {
        return new RemoveFromContainerService(
            $this->repository->container_placement,
            $this->repository->item_placement,
            $this->repository->stock_placement,
            $this->repository->item,
            $this->repository->stock
        );
    }

    public function incrementStockQty(): IncrementStockQtyService {
        return new IncrementStockQtyService(
            $this->repository->stock
        );
    }

    public function decrementStockQty(): DecrementStockQtyService {
        return new DecrementStockQtyService(
            $this->repository->stock
        );
    }

    public function deleteStock(): DeleteStockService {
        return new DeleteStockService(
            $this->repository->stock
        );
    }

    public function setItemCondition(): SetItemConditionService {
        return new SetItemConditionService(
            $this->repository->item
        );
    }

    public function markItemSold(): MarkItemSoldService {
        return new MarkItemSoldService();
    }

    public function archiveItem(): ArchiveItemService {
        return new ArchiveItemService();
    }

    public function returnItem(): ReturnItemService {
        return new ReturnItemService();
    }

    public function addPhoto(): AddPhotoService {
        return new AddPhotoService();
    }

    public function deletePhoto(): DeletePhotoService {
        return new DeletePhotoService();
    }

    public function setOwnerPermisition(): SetOwnerPermisitionService {
        return new SetOwnerPermisitionService();
    }

    public function getAllOwner(): GetAllOwnerService {
        return new GetAllOwnerService(
            $this->repository->owner
        );
    }

    public function getOwner(): GetOwnerService {
        return new GetOwnerService(
            $this->repository->owner
        );
    }

    public function deleteOwner(): DeleteOwnerService {
        return new DeleteOwnerService();
    }

    public function getHistory(): GetHistoryService {
        return new GetHistoryService();
    }

    public function getSales(): GetSalesService {
        return new GetSalesService();
    }

    public function createItem(): CreateItemService {
        return new CreateItemService(
            $this->repository->part,
            $this->repository->vehicle,
            $this->repository->item
        );
    }
}