<?php
namespace WarehouseCore\Context;

use WarehouseCore\Payload\DTO\SessionDTO;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Registry\ServiceRegistry;

use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\SalesService;
use WarehouseCore\Service\PartService;
use WarehouseCore\Service\VehicleService;
use WarehouseCore\Service\OwnerService;
use WarehouseCore\Service\PhysicalTagService;
use WarehouseCore\Service\ContainerService;
use WarehouseCore\Service\Identity\UserIdentityService;
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
use WarehouseCore\Service\VideoService;
use WarehouseCore\Service\ZoneService;

final class ServiceContext {
    public AreaService $area_service;
    public ContainerService $container_service;
    public UserService $user_service;
    public UserIdentityService $user_identity_service;
    public ItemService $item_service;
    public MovementService $movement_service;
    public OwnerService $owner_service;
    public PartService $part_service;
    public PhotoService $photo_service;
    public PhysicalTagService $physical_tag_service;
    public PlacementService $placement_service;
    public RackService $rack_service;
    public SalesService $sales_service;
    public ShelfService $shelf_service;
    public StockService $stock_service;
    public VehicleService $vehicle_service;
    public VideoService $video_service;
    public ZoneService $zone_service;
    public FindService $find_service;
    public GetService $get_service;
    public ListService $list_service;

    public function __construct(
        public readonly SessionDTO $session,
        private readonly Authorization $authorization,
        private readonly ServiceRegistry $service
    ) {
        $this->area_service = $this->service->area(
            $this->authorization
        );

        $this->container_service = $this->service->container(
            $this->authorization
        );

        $this->user_service = $this->service->user(
            $this->authorization
        );

        $this->user_identity_service = $this->service->userIdentity(
            $this->authorization
        );

        $this->item_service = $this->service->item(
            $this->authorization
        );

        $this->movement_service= $this->service->movement(
            $this->authorization
        );

        $this->owner_service = $this->service->owner(
            $this->authorization
        );

        $this->part_service = $this->service->part(
            $this->authorization
        );

        $this->photo_service = $this->service->photo(
            $this->authorization
        );
        
        $this->physical_tag_service = $this->service->physicalTag(
            $this->authorization
        );
        
        $this->placement_service = $this->service->placement(
            $this->authorization
        );
        
        $this->rack_service = $this->service->rack(
            $this->authorization
        );
        
        $this->sales_service = $this->service->sales(
            $this->authorization
        );

        $this->shelf_service = $this->service->shelf(
            $this->authorization
        );

        $this->stock_service = $this->service->stock(
            $this->authorization
        );

        $this->vehicle_service = $this->service->vehicle(
            $this->authorization
        );
        
        $this->video_service = $this->service->video(
            $this->authorization
        );
        
        $this->zone_service = $this->service->zone(
            $this->authorization
        );
        
        $this->find_service = $this->service->find(
            $this->authorization
        );
        
        $this->get_service = $this->service->get(
            $this->authorization
        );
        
        $this->list_service = $this->service->list(
            $this->authorization
        );
    }
}