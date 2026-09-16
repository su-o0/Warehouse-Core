<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\ServiceConfig;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\ContainerService;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\ItemService;
use WarehouseCore\Service\OwnerService;
use WarehouseCore\Service\PartService;
use WarehouseCore\Service\PhysicalTagService;
use WarehouseCore\Service\StockService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Query\ListService;
use WarehouseCore\Service\RackService;
use WarehouseCore\Service\SalesService;
use WarehouseCore\Service\ShelfService;
use WarehouseCore\Service\StorageSlotService;
use WarehouseCore\Service\VehicleService;
use WarehouseCore\Service\ZoneService;

final class ServiceRegistry {
    private ?AreaService $area = null;
    private ?ContainerService $container = null;
    private ?ItemService $item = null;
    private ?OwnerService $owner = null;
    private ?PartService $part = null;
    private ?PhysicalTagService $physical_tag = null;
    private ?RackService $rack = null;
    private ?SalesService $sales = null;
    private ?StorageSlotService $storage_slot = null;
    private ?StockService $stock = null;
    private ?UserService $user = null;
    private ?VehicleService $vehicle = null;
    private ?ZoneService $zone = null;
    private ?FindService $find = null;
    private ?GetService $get = null;
    private ?ListService $list = null;

    public function __construct(
        private ServiceConfig $config,
        private RepositoryRegistry $repository, 
        private TransactionRegistry $transaction,
    ) { }

    public function area(
        Authorization $authorization
    ): AreaService {
        return $this->area ??= new AreaService(
            $this->config->area,
            $authorization,
            $this->repository->area(),
            $this->repository->areaName(),
            $this->repository->areaAccess(),
            $this->transaction->createArea(),
            $this->transaction->addAreaName(),
            $this->transaction->setPrimaryAreaName()
        );
    }

    public function container(
        Authorization $authorization
    ): ContainerService {
        return $this->container ??= new ContainerService(
            $this->config->container,
            $authorization,
            $this->repository->container()
        );
    }

    public function item(
        Authorization $authorization
    ): ItemService {
        return $this->item ??=new ItemService(
            $this->config->item,
            $authorization,
            $this->repository->item(),
            $this->repository->itemProcessingStep()
        );
    }

    public function owner(
        Authorization $authorization
    ): OwnerService {
        return $this->owner ??= new OwnerService(
            $this->config->owner,
            $authorization,
            $this->repository->owner(),
            $this->repository->user()
        );
    }

    public function part(
        Authorization $authorization
    ): PartService {
        return $this->part ??= new PartService(
            $this->config->part,
            $authorization,
            $this->repository->part(),
            $this->repository->partNumber(),
            $this->repository->partName()
        );
    }

    public function physicalTag(
        Authorization $authorization
    ): PhysicalTagService {
        return $this->physical_tag ??=new PhysicalTagService(
            $this->config->physical_tag,
            $authorization,
            $this->repository->physicalTag()
        );
    }

    public function rack(
        Authorization $authorization
    ): RackService {
        return $this->rack ??=new RackService(
            $this->config->rack,
            $authorization,
            $this->repository->rack(),
            $this->repository->rackName(),
            $this->repository->rackProcessingStep(),
            $this->transaction->populateRack(),
            $this->transaction->activateRack(),
            $this->transaction->archiveRack(),
            $this->transaction->addRackName(),
            $this->transaction->setPrimaryRackName()
        );
    }

    public function sales(
        Authorization $authorization
    ): SalesService {
        return $this->sales ??=new SalesService(
            $this->config->sales,
            $authorization,
            $this->repository->itemSalesArchive(),
            $this->repository->stockSalesArchive()
        );
    }

    public function shelf(
        Authorization $authorization
    ): ShelfService {
        return $this->shelf ??=new ShelfService(
            $this->config->shelf,
            $authorization,
            $this->repository->shelf(),
            $this->repository->rackProcessingStep(),
            $this->transaction->registerShelf(),
            $this->transaction->removeShelf()
        );
    }

    public function storageSlot(
        Authorization $authorization
    ): StorageSlotService {
        return$this->storage_slot ??= new StorageSlotService(
            $this->config->storage_slot,
            $authorization,
            $this->repository->storageSlot(),
            $this->repository->rackProcessingStep(),
            $this->transaction->registerStorageSlot(),
            $this->transaction->removeStorageSlot()
        );
    }

    public function stock(
        Authorization $authorization
    ): StockService {
        return $this->stock ??=new StockService(
            $this->config->stock,
            $authorization,
            $this->repository->stock(),
            $this->repository->part()
        );
    }
    
    public function user(
        Authorization $authorization
    ): UserService {
        return $this->user ??=new UserService(
            $this->config->user,
            $authorization,
            $this->repository->role(),
            $this->repository->user(),
            $this->repository->userName(),
            $this->repository->userProcessingStep(),
            $this->repository->userIdentity(),
            $this->transaction->assignUserRole(),
            $this->transaction->dismissUserRole(),
            $this->transaction->addUserName(),
            $this->transaction->setPrimaryUserName(),
            $this->transaction->removeUserName(),
            $this->transaction->addUserIdentity(),
            $this->transaction->removeUserIdentity()
        );
    }
     
    public function vehicle(
        Authorization $authorization
    ): VehicleService {
        return $this->vehicle ??=new VehicleService(
            $this->config->vehicle,
            $authorization,
            $this->repository->vehicle()
        );
    }

    public function zone(
        Authorization $authorization
    ): ZoneService {
        return $this->zone ??= new ZoneService(
            $this->config->zone,
            $authorization,
            $this->repository->zone(),
            $this->repository->zoneName(),
            $this->repository->zonePlacement(),
            $this->repository->zoneProcessingStep(),
            $this->repository->zonePhoto(),
            $this->transaction->addZoneName(),
            $this->transaction->setPrimaryZoneName(),
            $this->transaction->placeZoneToArea()
        );
    }

    public function find(
        Authorization $authorization
    ): FindService {
        return $this->find ??= new FindService(
            $this->config->find,
            $authorization,
            $this->repository->shelf(),
            $this->repository->storageSlot(),
            $this->repository->containerPlacement(),
            $this->repository->itemPlacement(),
            $this->repository->rackPlacement(),
            $this->repository->stockPlacement(),
            $this->repository->area(),
            $this->repository->zone(),
            $this->repository->item(),
            $this->repository->stock(),
            $this->repository->container(),
            $this->repository->itemProcessingStep(),
            $this->repository->partProcessingStep(),
            $this->repository->userIdentity(),
            $this->repository->user(),
            $this->repository->owner(),
            $this->repository->partNumber(),
            $this->repository->partName(),
            $this->repository->areaName(),
            $this->repository->rackName(),
            $this->repository->zoneName(),
            $this->repository->userName(),
            $this->repository->owner(),
            $this->repository->physicalTag(),
            $this->repository->itemSalesArchive(),
            $this->repository->stockSalesArchive(),
            $this->repository->containerMovementArchive(),
            $this->repository->containerPlacementArchive(),
            $this->repository->itemMovementArchive(),
            $this->repository->itemPlacementArchive(),
            $this->repository->rackMovementArchive(),
            $this->repository->rackPlacementArchive(),
            $this->repository->stockMovementArchive(),
            $this->repository->stockPlacementArchive()
        );
    }

    public function get(
        Authorization $authorization
    ) : GetService {
        return $this->get ??= new GetService(
            $this->config->get, 
            $authorization,
            $this->repository->area(),
            $this->repository->container(),
            $this->repository->item(),
            $this->repository->owner(),
            $this->repository->part(),
            $this->repository->physicalTag(),
            $this->repository->rack(),
            $this->repository->shelf(),  
            $this->repository->storageSlot(),  
            $this->repository->stock(),
            $this->repository->storedFile(),      
            $this->repository->user(),
            $this->repository->zone(),
            $this->repository->role(),
            $this->repository->provider() 
        );
    }

    public function list(
        Authorization $authorization
    ): ListService {
        return $this->list ??= new ListService(
            $this->config->list,
            $authorization,
            $this->repository->area(),
            $this->repository->areaName(),
            $this->repository->areaAccess(),
            $this->repository->user(),
            $this->repository->userName(),
            $this->repository->userIdentity(),
            $this->repository->userProcessingStep(),
            $this->repository->zone(),
            $this->repository->zoneName(),
            $this->repository->rack(),
            $this->repository->rackName()
        );
    }
}