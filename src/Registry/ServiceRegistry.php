<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\ServiceConfig;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Service\Audit\SalesService;
use WarehouseCore\Service\Audit\TelemetryService;
use WarehouseCore\Service\Catalog\PartService;
use WarehouseCore\Service\Catalog\VehicleService;
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
        private ServiceConfig $config,
    ) { }

    public function get() : GetService {
        return new GetService(
            $this->config->get, 
            $this->repository->physical_tag,
            $this->repository->container,
            $this->repository->user,        
            $this->repository->owner,
            $this->repository->vehicle,
            $this->repository->role,    
            $this->repository->location
        );
    }

    public function telemetry(): TelemetryService {
        return new TelemetryService(
            $this->config->telemetry,
            $this->repository->telemetry
        );
    }

    public function find(
        Authorization $authorization
    ): FindService {
        return new FindService(
            $this->config->find,
            $authorization,
            $this->repository->role,
            $this->repository->user_identity,
            $this->repository->user,
            $this->repository->location,
            $this->repository->part,
            $this->repository->part_alias
        );
    }
    public function sales(
        Authorization $authorization
    ): SalesService {
        return new SalesService(
            $this->config->sales,
            $authorization,
            $this->repository->item_sales_arhive,
            $this->repository->stock_sales_arhive
        );
    }

    public function part(
        Authorization $authorization
    ): PartService {
        return new PartService(
            $this->config->part,
            $authorization,
            $this->repository->part,
            $this->repository->part_alias
        );
    }

    public function vehicle(
        Authorization $authorization
    ): VehicleService {
        return new VehicleService(
            $this->config->vehicle,
            $authorization,
            $this->repository->vehicle
        );
    }

    public function owner(
        Authorization $authorization
    ): OwnerService {
        return new OwnerService(
            $this->config->owner,
            $authorization,
            $this->repository->owner,
            $this->repository->user
        );
    }

    public function physicalTag(
        Authorization $authorization
    ): PhysicalTagService {
        return new PhysicalTagService(
            $this->config->physical_tag,
            $authorization,
            $this->repository->physical_tag
        );
    }

    public function userIdentity(
        Authorization $authorization
    ): UserIdentityService {
        return new UserIdentityService(
            $this->config->user_identity,
            $authorization,
            $this->repository->user_identity
        );
    }

    public function user(
        Authorization $authorization
    ): UserService {
        return new UserService(
            $this->config->user,
            $authorization,
            $this->repository->user
        );
    }

    public function container(
        Authorization $authorization
    ): ContainerService {
        return new ContainerService(
            $this->config->container,
            $authorization,
            $this->repository->container
        );
    }

    public function item(
        Authorization $authorization
    ): ItemService {
        return new ItemService(
            $this->config->item,
            $authorization,
            $this->repository->item,
            $this->repository->item_placement,
            $this->repository->item_processing_step,
            $this->repository->physical_tag,
        );
    }

    public function stock(
        Authorization $authorization
    ): StockService {
        return new StockService(
            $this->config->stock,
            $authorization,
            $this->repository->stock,
            $this->repository->part
        );
    }

    public function movement(
        Authorization $authorization
    ): MovementService {
        return new MovementService(
            $this->config->movement,
            $authorization,
            $this->repository->location,
            $this->repository->container,
            $this->repository->container_placement,
            $this->repository->item,
            $this->repository->item_placement,
            $this->repository->stock,
            $this->repository->stock_placement
        );
    }

    public function placement(
        Authorization $authorization
    ): PlacementService {
        return new PlacementService(
            $this->config->placement,
            $authorization,
            $this->repository->location,
            $this->repository->container,
            $this->repository->container_placement,
            $this->repository->item,
            $this->repository->item_placement,
            $this->repository->stock,
            $this->repository->stock_placement
        );
    }

    public function location(
        Authorization $authorization
    ): LocationService {
        return new LocationService(
            $this->config->location,
            $authorization,
            $this->repository->location
        );
    }

    public function photo(
        Authorization $authorization
    ): PhotoService {
        return new PhotoService(
            $this->config->photo,
            $authorization,
            $this->repository->part_photo,
            $this->repository->item_photo,
            $this->repository->stock_photo,
            $this->repository->vehicle_photo
        );
    }
}