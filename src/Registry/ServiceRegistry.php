<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\ServiceConfig;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\ContainerService;
use WarehouseCore\Service\Identity\UserIdentityService;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\ItemService;
use WarehouseCore\Service\MovementService;
use WarehouseCore\Service\OwnerService;
use WarehouseCore\Service\PartService;
use WarehouseCore\Service\PhotoService;
use WarehouseCore\Service\PhysicalTagService;
use WarehouseCore\Service\StockService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Query\ListService;
use WarehouseCore\Service\PlacementService;
use WarehouseCore\Service\RackService;
use WarehouseCore\Service\SalesService;
use WarehouseCore\Service\ShelfService;
use WarehouseCore\Service\VehicleService;
use WarehouseCore\Service\VideoService;
use WarehouseCore\Service\ZoneService;

final class ServiceRegistry {
    public function __construct(
        private ServiceConfig $config,
        private RepositoryRegistry $repository, 
        private TransactionRegistry $transaction,
    ) { }

    public function area(
        Authorization $authorization
    ): AreaService {
        return new AreaService(
            $this->config->area,
            $authorization,
            $this->repository->area,
            $this->repository->area_name,
            $this->repository->area_access,
            $this->transaction->create_area,
            $this->transaction->add_area_name,
            $this->transaction->set_primary_area_name
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
            $this->repository->item_processing_step
        );
    }

    public function movement(
        Authorization $authorization
    ): MovementService {
        return new MovementService(
            $this->config->movement,
            $authorization,
            $this->repository->container,
            $this->repository->container_placement,
            $this->repository->item,
            $this->repository->item_placement,
            $this->repository->stock,
            $this->repository->stock_placement
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

    public function part(
        Authorization $authorization
    ): PartService {
        return new PartService(
            $this->config->part,
            $authorization,
            $this->repository->part,
            $this->repository->part_number,
            $this->repository->part_name
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

    public function physicalTag(
        Authorization $authorization
    ): PhysicalTagService {
        return new PhysicalTagService(
            $this->config->physical_tag,
            $authorization,
            $this->repository->physical_tag
        );
    }

    public function placement(
        Authorization $authorization
    ): PlacementService {
        return new PlacementService(
            $this->config->placement,
            $authorization,
            $this->repository->container_placement,
            $this->repository->item_placement,
            $this->repository->stock_placement
        );
    }

    public function rack(
        Authorization $authorization
    ): RackService {
        return new RackService(
            $this->config->rack,
            $authorization,
            $this->repository->rack,
            $this->repository->rack_name
        );
    }


    public function sales(
        Authorization $authorization
    ): SalesService {
        return new SalesService(
            $this->config->sales,
            $authorization,
            $this->repository->item_sales_archive,
            $this->repository->stock_sales_archive
        );
    }

    public function shelf(
        Authorization $authorization
    ): ShelfService {
        return new ShelfService(
            $this->config->sales,
            $authorization,
            $this->repository->shelf,
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
     
    public function vehicle(
        Authorization $authorization
    ): VehicleService {
        return new VehicleService(
            $this->config->vehicle,
            $authorization,
            $this->repository->vehicle
        );
    }

    public function video(
        Authorization $authorization
    ): VideoService {
        return new VideoService(
            $this->config->video,
            $authorization,
        );
    }

    public function zone(
        Authorization $authorization
    ): ZoneService {
        return new ZoneService(
            $this->config->zone,
            $authorization,
        );
    }

    public function find(
        Authorization $authorization
    ): FindService {
        return new FindService(
            $this->config->find,
            $authorization,
            $this->repository->container_placement,
            $this->repository->item_placement,
            $this->repository->rack_placement,
            $this->repository->stock_placement,
            $this->repository->area,
            $this->repository->zone,
            $this->repository->item,
            $this->repository->stock,
            $this->repository->container,
            $this->repository->item_processing_step,
            $this->repository->part_processing_step,
            $this->repository->user_identity,
            $this->repository->user,
            $this->repository->owner,
            $this->repository->part_number,
            $this->repository->part_name,
            $this->repository->area_name,
            $this->repository->rack_name,
            $this->repository->zone_name,
            $this->repository->owner,
            $this->repository->physical_tag,
            $this->repository->item_sales_archive,
            $this->repository->stock_sales_archive,
            $this->repository->container_movement_archive,
            $this->repository->container_placement_archive,
            $this->repository->item_movement_archive,
            $this->repository->item_placement_archive,
            $this->repository->rack_movement_archive,
            $this->repository->rack_placement_archive,
            $this->repository->stock_movement_archive,
            $this->repository->stock_placement_archive
        );
    }

    public function get(
        Authorization $authorization
    ) : GetService {
        return new GetService(
            $this->config->get, 
            $authorization,
            $this->repository->area,
            $this->repository->container,
            $this->repository->item,
            $this->repository->owner,
            $this->repository->part,
            $this->repository->physical_tag,
            $this->repository->rack,
            $this->repository->shelf,  
            $this->repository->stock,
            $this->repository->stored_file,      
            $this->repository->user,
            $this->repository->zone,
            $this->repository->role,
            $this->repository->provider 
        );
    }

    public function list(
        Authorization $authorization
    ): ListService {
        return new ListService(
            $this->config->list,
            $authorization,
            $this->repository->area,
            $this->repository->area_name,
            $this->repository->area_access,
            
        );
    }
}