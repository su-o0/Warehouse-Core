<?php
namespace WarehouseCore\Context;

use WarehouseCore\Payload\DTO\Session;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Registry\ServiceRegistry;

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

final class ServiceContext {
    public function __construct(
        public readonly Session $session,
        private readonly Authorization $authorization,
        private readonly ServiceRegistry $service
    ) { }

    public function get(): GetService {
        return $this->service->get();
    }

    public function telemetry(): TelemetryService {
        return $this->service->telemetry();
    }

    public function find(): FindService {
        return $this->service->find(
            $this->authorization
        );
    }

    public function sales(): SalesService {
        return $this->service->sales(
            $this->authorization
        );
    }

    public function part(): PartService {
        return $this->service->part(
            $this->authorization
        );
    }
    
    public function vehicle(): VehicleService {
        return $this->service->vehicle(
            $this->authorization
        );  
    }

    public function owner(): OwnerService {
        return $this->service->owner(
            $this->authorization
        );
    }

    public function physicalTag(): PhysicalTagService {
        return $this->service->physicalTag(
            $this->authorization
        );
    }

    public function userIdentity(): UserIdentityService {
        return $this->service->userIdentity(
            $this->authorization
        );
    }

    public function user(): UserService {
        return $this->service->user(
            $this->authorization
        );
    }

    public function container(): ContainerService {
        return $this->service->container(
            $this->authorization
        );
    }

    public function item(): ItemService {
        return $this->service->item(
            $this->authorization
        );
    }

    public function stock(): StockService {
        return $this->service->stock(
            $this->authorization
        );
    }

    public function movement(): MovementService {
        return $this->service->movement(
            $this->authorization
        );
    }

    public function placement(): PlacementService {
        return $this->service->placement(
            $this->authorization
        );
    }

    public function location(): LocationService {
        return $this->service->location(
            $this->authorization
        );
    }

    public function photo(): PhotoService {
        return $this->service->photo(
            $this->authorization
        );
    }
}