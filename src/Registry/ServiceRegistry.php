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
use WarehouseCore\Service\Setup\AddPartService;
use WarehouseCore\Service\Setup\AddVehicleService;

final class ServiceRegistry {
    public function __construct(
        private RepositoryRegistry $repository, 
    ) { }

    public function authentication(): AuthenticationService {
        return new AuthenticationService(
            $this->repository->user
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



}