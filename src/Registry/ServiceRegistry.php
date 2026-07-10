<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Service\Audit\TelemetryService;
use WarehouseCore\Service\Audit\SalesService;
use WarehouseCore\Service\Catalog\PartService;
use WarehouseCore\Service\Catalog\VehicleService;
use WarehouseCore\Service\Identity\AuthenticationService;
use WarehouseCore\Service\Identity\OwnerService;
use WarehouseCore\Service\Identity\PhysicalTagService;
use WarehouseCore\Service\Identity\UserIdentityService;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Inventory\ContainerService;
use WarehouseCore\Service\Inventory\ItemService;
use WarehouseCore\Service\Inventory\StockService;
use WarehouseCore\Service\Media\PhotoService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Topology\LocationService;
use WarehouseCore\Service\Topology\MovementService;
use WarehouseCore\Service\Topology\PlacementService;

final class ServiceRegistry {
    public function __construct(
        private RepositoryRegistry $repository, 
    ) { }

    public function find(): FindService {
        return new FindService(
            $this->repository->location
        );
    }

    public function get() : GetService {
        return new GetService(
            $this->repository->location
        );
    }

    public function telemetry(): TelemetryService {
        return new TelemetryService(
            $this->repository->telemetry
        );
    }

    public function sales(): SalesService {
        return new SalesService(
            $this->repository->item_sales_arhive,
            $this->repository->stock_sales_arhive
        );
    }

    public function part(): PartService {
        return new PartService(
            $this->repository->part
        );
    }

    public function vehicle(): VehicleService {
        return new VehicleService(
            $this->repository->vehicle
        );
    }
    
    public function authentication(): AuthenticationService {
        return new AuthenticationService(
            $this->repository->user,
            $this->repository->user_identity
        );
    }

    public function owner(): OwnerService {
        return new OwnerService(
            $this->repository->owner,
            $this->repository->user
        );
    }

    public function physicalTag(): PhysicalTagService {
        return new PhysicalTagService(
            $this->repository->physical_tag
        );
    }

    public function userIdentity(): UserIdentityService {
        return new UserIdentityService(
            $this->repository->user,
            $this->repository->user_identity
        );
    }

    public function user(): UserService {
        return new UserService(
            $this->repository->user
        );
    }

    public function container(): ContainerService {
        return new ContainerService(
            $this->repository->container
        );
    }

    public function item(): ItemService {
        return new ItemService(
            $this->repository->item,
            $this->repository->physical_tag,
            $this->repository->part,
            $this->repository->vehicle
        );
    }

    public function stock(): StockService {
        return new StockService(
            $this->repository->stock,
            $this->repository->part
        );
    }

    public function movement(): MovementService {
        return new MovementService(
            $this->repository->location,
            $this->repository->container,
            $this->repository->container_placement,
            $this->repository->item,
            $this->repository->item_placement,
            $this->repository->stock,
            $this->repository->stock_placement
        );
    }

    public function placement(): PlacementService {
        return new PlacementService(
            $this->repository->location,
            $this->repository->container,
            $this->repository->container_placement,
            $this->repository->item,
            $this->repository->item_placement,
            $this->repository->stock,
            $this->repository->stock_placement
        );
    }

    public function location(): LocationService {
        return new LocationService(
            $this->repository->location
        );
    }

    public function photo(): PhotoService {
        return new PhotoService(
            $this->repository->item_photo,
            $this->repository->stock_photo,
            $this->repository->vehicle_photo
        );
    }
}