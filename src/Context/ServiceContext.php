<?php
namespace WarehouseCore\Context;

use WarehouseCore\Payload\DTO\SessionDTO;
use WarehouseCore\Payload\Entity\StorageSlotEntity;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Registry\ServiceRegistry;

use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\SalesService;
use WarehouseCore\Service\PartService;
use WarehouseCore\Service\VehicleService;
use WarehouseCore\Service\OwnerService;
use WarehouseCore\Service\PhysicalTagService;
use WarehouseCore\Service\ContainerService;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\ItemService;
use WarehouseCore\Service\StockService;
use WarehouseCore\Service\PhotoService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Query\ListService;
use WarehouseCore\Service\MovementService;
use WarehouseCore\Service\PlacementService;
use WarehouseCore\Service\RackService;
use WarehouseCore\Service\ShelfService;
use WarehouseCore\Service\StorageSlotService;
use WarehouseCore\Service\VideoService;
use WarehouseCore\Service\ZoneService;

final class ServiceContext {
    private ?AreaService $area_service = null;
    private ?ContainerService $container_service = null;
    private ?UserService $user_service = null;
    private ?ItemService $item_service = null;
    private ?MovementService $movement_service = null;
    private ?OwnerService $owner_service = null;
    private ?PartService $part_service = null;
    private ?PhotoService $photo_service = null;
    private ?PhysicalTagService $physical_tag_service = null;
    private ?PlacementService $placement_service = null;
    private ?RackService $rack_service = null;
    private ?SalesService $sales_service = null;
    private ?ShelfService $shelf_service = null;
    private ?StorageSlotService $storage_slot_service = null;
    private ?StockService $stock_service = null;
    private ?VehicleService $vehicle_service = null;
    private ?VideoService $video_service = null;
    private ?ZoneService $zone_service = null;
    private ?FindService $find_service = null;
    private ?GetService $get_service = null;
    private ?ListService $list_service = null;

    public function __construct(
        public readonly SessionDTO $session,
        private readonly Authorization $authorization,
        private readonly ServiceRegistry $service
    ) { }

    public function areaService(): AreaService {
        return $this->area_service ??= $this->service->area(
            $this->authorization
        );
    }

    public function containerService(): ContainerService {
        return $this->container_service ??= $this->service->container(
            $this->authorization
        );
    }

    public function userService(): UserService {
       return $this->user_service ??= $this->service->user(
            $this->authorization
        );
    }

    public function itemService(): ItemService {
        return $this->item_service ??= $this->service->item(
            $this->authorization
        );
    }

    public function movementService(): MovementService {
        return $this->movement_service ??= $this->service->movement(
            $this->authorization
        );
    }

    public function ownerService(): OwnerService {
        return $this->owner_service ??= $this->service->owner(
            $this->authorization
        );
    }

    public function partService(): PartService {
        return $this->part_service ??= $this->service->part(
            $this->authorization
        );
    }

    public function photoService(): PhotoService {
        return $this->photo_service ??= $this->service->photo(
            $this->authorization
        );
    }
    
    public function physicalTagService(): PhysicalTagService {
        return $this->physical_tag_service ??= $this->service->physicalTag(
            $this->authorization
        );
    }

    public function placementService(): PlacementService {
        return $this->placement_service ??= $this->service->placement(
            $this->authorization
        );
    }
    
    public function rackService(): RackService {
        return $this->rack_service ??= $this->service->rack(
            $this->authorization
        );
    }
    
    public function salesService(): SalesService {
        return $this->sales_service ??= $this->service->sales(
            $this->authorization
        );
    }

    public function shelfService(): ShelfService {
        return $this->shelf_service ??= $this->service->shelf(
            $this->authorization
        );
    }

    public function storageSlotService(): StorageSlotService {
        return $this->storage_slot_service ??= $this->service->storageSlot(
            $this->authorization
        );
    }

    public function stockService(): StockService {
        return $this->stock_service ??= $this->service->stock(
            $this->authorization
        );
    }

    public function vehicleService(): VehicleService {
        return $this->vehicle_service ??= $this->service->vehicle(
            $this->authorization
        );
    }
    
    public function videoService(): VideoService {
        return $this->video_service ??= $this->service->video(
            $this->authorization
        );
    }

    public function zoneService(): ZoneService {
        return $this->zone_service ??= $this->service->zone(
            $this->authorization
        );
    }
    
    public function findService(): FindService {
        return $this->find_service ??= $this->service->find(
            $this->authorization
        );
    }

    public function getService(): GetService {
        return $this->get_service ??= $this->service->get(
            $this->authorization
        );
    }

    public function listService(): ListService {
        return $this->list_service ??= $this->service->list(
            $this->authorization
        );
    }
}