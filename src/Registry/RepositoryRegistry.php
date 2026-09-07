<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\RepositoryConfig;
use WarehouseCore\Connection\Connection;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Repository\Topology\ZoneRepository;
use WarehouseCore\Repository\Topology\RackPlacementRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Topology\ShelfRepository;
use WarehouseCore\Repository\Topology\StorageSlotRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Inventory\PhysicalTagRepository;
use WarehouseCore\Repository\Processing\ItemProcessingStepRepository;
use WarehouseCore\Repository\Processing\PartProcessingStepRepository;
use WarehouseCore\Repository\Catalog\AreaNameRepository;
use WarehouseCore\Repository\Catalog\ZoneNameRepository;
use WarehouseCore\Repository\Catalog\RackNameRepository;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Catalog\PartNumberRepository;
use WarehouseCore\Repository\Catalog\PartNameRepository;
use WarehouseCore\Repository\Catalog\VehicleRepository;
use WarehouseCore\Repository\Media\PartPhotoRepository;
use WarehouseCore\Repository\Media\ItemPhotoRepository;
use WarehouseCore\Repository\Media\StockPhotoRepository;
use WarehouseCore\Repository\Media\VehiclePhotoRepository;
use WarehouseCore\Repository\Media\PartVideoRepository;
use WarehouseCore\Repository\Media\ItemVideoRepository;
use WarehouseCore\Repository\Media\StockVideoRepository;
use WarehouseCore\Repository\Media\VehicleVideoRepository;
use WarehouseCore\Repository\Audit\RackPlacementArchiveRepository;
use WarehouseCore\Repository\Audit\ContainerPlacementArchiveRepository;
use WarehouseCore\Repository\Audit\ItemPlacementArchiveRepository;
use WarehouseCore\Repository\Audit\StockPlacementArchiveRepository;
use WarehouseCore\Repository\Audit\RackMovementArchiveRepository;
use WarehouseCore\Repository\Audit\ContainerMovementArchiveRepository;
use WarehouseCore\Repository\Audit\ItemMovementArchiveRepository;
use WarehouseCore\Repository\Audit\ItemSalesArchiveRepository;
use WarehouseCore\Repository\Audit\StockMovementArchiveRepository;
use WarehouseCore\Repository\Audit\StockSalesArchiveRepository;
use WarehouseCore\Repository\Catalog\UserNameRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\ProviderRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\AreaAccessRepository;
use WarehouseCore\Repository\Media\StoredFileRepository;
use WarehouseCore\Repository\Processing\RackProcessingStepRepository;
use WarehouseCore\Repository\Processing\UserProcessingStepRepository;

final class RepositoryRegistry {
    private \PDO $db;

    private ?AreaRepository $area = null;
    private ?ZoneRepository $zone = null;
    private ?RackPlacementRepository $rack_placement = null;
    private ?ContainerPlacementRepository $container_placement = null;
    private ?ItemPlacementRepository $item_placement = null;
    private ?StockPlacementRepository $stock_placement = null;
    private ?RackRepository $rack = null;
    private ?ShelfRepository $shelf = null;
    private ?StorageSlotRepository $storage_slot = null;
    private ?ContainerRepository $container = null;
    private ?ItemRepository $item = null;
    private ?StockRepository $stock = null;
    private ?PhysicalTagRepository $physical_tag = null;
    private ?ItemProcessingStepRepository $item_processing_step = null;
    private ?PartProcessingStepRepository $part_processing_step = null;
    private ?AreaNameRepository $area_name = null;
    private ?ZoneNameRepository $zone_name = null;
    private ?RackNameRepository $rack_name = null;
    private ?PartRepository $part = null;
    private ?PartNumberRepository $part_number = null;
    private ?PartNameRepository $part_name = null;
    private ?VehicleRepository $vehicle = null;
    private ?PartPhotoRepository $part_photo = null;
    private ?ItemPhotoRepository $item_photo = null;
    private ?StockPhotoRepository $stock_photo = null;
    private ?VehiclePhotoRepository $vehicle_photo = null;
    private ?PartVideoRepository $part_video = null;
    private ?ItemVideoRepository $item_video = null;
    private ?StockVideoRepository $stock_video = null;
    private ?VehicleVideoRepository $vehicle_video = null;
    private ?StoredFileRepository $stored_file = null; 
    private ?RackPlacementArchiveRepository $rack_placement_archive = null;
    private ?ContainerPlacementArchiveRepository $container_placement_archive = null;
    private ?ItemPlacementArchiveRepository $item_placement_archive = null;
    private ?StockPlacementArchiveRepository $stock_placement_archive = null;
    private ?RackMovementArchiveRepository $rack_movement_archive = null;
    private ?ContainerMovementArchiveRepository $container_movement_archive = null;
    private ?ItemMovementArchiveRepository $item_movement_archive = null;
    private ?StockMovementArchiveRepository $stock_movement_archive = null;
    private ?ItemSalesArchiveRepository $item_sales_archive = null;
    private ?StockSalesArchiveRepository $stock_sales_archive = null;
    private ?RoleRepository $role = null;
    private ?ProviderRepository $provider = null;
    private ?UserRepository $user = null;
    private ?UserIdentityRepository $user_identity = null;
    private ?OwnerRepository $owner = null;
    private ?AreaAccessRepository $area_access = null;
    private ?UserNameRepository $user_name = null;
    private ?UserProcessingStepRepository $user_processing_step = null;
    private ?RackProcessingStepRepository $rack_processing_step = null;

    public function __construct(
        private RepositoryConfig $config,
        Connection $connection
    ) { 
        $this->db = $connection->get();
    }

    public function area(): AreaRepository {
        return $this->area ??= new AreaRepository(
            $this->db, 
            $this->config->area
        );
    }

    public function zone(): ZoneRepository {
        return $this->zone ??= new ZoneRepository(
            $this->db, 
            $this->config->zone
        );
    }

    public function rackPlacement(): RackPlacementRepository {
        return $this->rack_placement ??= new RackPlacementRepository(
            $this->db, 
            $this->config->rack_placement
        );
    }

    public function containerPlacement(): ContainerPlacementRepository {
        return $this->container_placement ??= new ContainerPlacementRepository(
            $this->db, 
            $this->config->container_placement
        );
    }

    public function itemPlacement(): ItemPlacementRepository {
        return $this->item_placement ??= new ItemPlacementRepository(
            $this->db, 
            $this->config->item_placement
        );
    }
    
    public function stockPlacement(): StockPlacementRepository {
        return $this->stock_placement ??= new StockPlacementRepository(
            $this->db, 
            $this->config->stock_placement
        );
    }
    
    public function rack(): RackRepository {
        return $this->rack ??= new RackRepository(
            $this->db, 
            $this->config->rack
        );
    }
    
    public function shelf(): ShelfRepository {
        return $this->shelf ??= new ShelfRepository(
            $this->db, 
            $this->config->shelf
        );
    }
    
    public function storageSlot(): StorageSlotRepository {
        return $this->storage_slot ??= new StorageSlotRepository(
            $this->db, 
            $this->config->storage_slot
        );
    }
    
    public function container(): ContainerRepository {
        return $this->container ??= new ContainerRepository(
            $this->db, 
            $this->config->container
        );
    }
    
    public function item(): ItemRepository {
        return $this->item ??= new ItemRepository(
            $this->db, 
            $this->config->item
        );
    }
    
    public function stock(): StockRepository {
        return $this->stock ??= new StockRepository(
            $this->db, 
            $this->config->stock
        );
    }
    
    public function physicalTag(): PhysicalTagRepository {
        return $this->physical_tag ??= new PhysicalTagRepository(
            $this->db, 
            $this->config->physical_tag
        );
    }
    
    public function itemProcessingStep(): ItemProcessingStepRepository {
        return $this->item_processing_step ??= new ItemProcessingStepRepository(
            $this->db,
            $this->config->item_processing_step
        );
    }
    
    public function partProcessingStep(): PartProcessingStepRepository {
        return $this->part_processing_step ??= new PartProcessingStepRepository(
            $this->db,
            $this->config->part_processing_step
        );
    }
    
    public function areaName(): AreaNameRepository {
        return $this->area_name ??= new AreaNameRepository(
            $this->db,
            $this->config->area_name
        );
    }
    
    public function zoneName(): ZoneNameRepository {
        return $this->zone_name ??= new ZoneNameRepository(
            $this->db,
            $this->config->zone_name
        );
    }
    
    public function rackName(): RackNameRepository {
        return $this->rack_name ??= new RackNameRepository(
            $this->db,
            $this->config->rack_name
        );
    }
    
    public function part(): PartRepository {
        return $this->part ??= new PartRepository(
            $this->db, 
            $this->config->part
        );
    }
    
    public function partNumber(): PartNumberRepository {
        return $this->part_number ??= new PartNumberRepository(
            $this->db, 
            $this->config->part_number
        );
    }
    
    public function partName(): PartNameRepository {
        return $this->part_name ??= new PartNameRepository(
            $this->db, 
            $this->config->part_name
        );
    }
    
    public function vehicle(): VehicleRepository {
        return $this->vehicle ??= new VehicleRepository(
            $this->db, 
            $this->config->vehicle
        );
    }
    
    public function partPhoto(): PartPhotoRepository {
        return $this->part_photo ??= new PartPhotoRepository(
            $this->db,
            $this->config->part_photo
        );
    }
    
    public function itemPhoto(): ItemPhotoRepository {
        return $this->item_photo ??= new ItemPhotoRepository(
            $this->db, 
            $this->config->item_photo
        );
    }
    
    public function stockPhoto(): StockPhotoRepository {
        return $this->stock_photo ??= new StockPhotoRepository(
            $this->db, 
            $this->config->stock_photo
        );
    }
    
    public function vehiclePhoto(): VehiclePhotoRepository {
        return $this->vehicle_photo ??= new VehiclePhotoRepository(
            $this->db, 
            $this->config->vehicle_photo
        );
    }
    
    public function partVideo(): PartVideoRepository {
        return $this->part_video ??= new PartVideoRepository(
            $this->db,
            $this->config->part_video
        );
    }
    
    public function itemVideo(): ItemVideoRepository {
        return $this->item_video ??= new ItemVideoRepository(
            $this->db, 
            $this->config->item_video
        );
    }
    
    public function stockVideo(): StockVideoRepository {
        return $this->stock_video ??= new StockVideoRepository(
            $this->db, 
            $this->config->stock_video
        );
    }
    
    public function vehicleVideo(): VehicleVideoRepository {
        return $this->vehicle_video ??= new VehicleVideoRepository(
            $this->db, 
            $this->config->vehicle_video
        );
    }
    
    public function storedFile(): StoredFileRepository {
        return $this->stored_file ??= new StoredFileRepository(
            $this->db,
            $this->config->stored_file
        );
    }
    
    public function rackPlacementArchive(): RackPlacementArchiveRepository {
        return $this->rack_placement_archive ??= new RackPlacementArchiveRepository(
            $this->db,
            $this->config->rack_placement_archive
        );
    }
    
    public function containerPlacementArchive(): ContainerPlacementArchiveRepository {
        return $this->container_placement_archive ??= new ContainerPlacementArchiveRepository(
            $this->db,
            $this->config->container_placement_archive
        );
    }
    
    public function itemPlacementArchive(): ItemPlacementArchiveRepository{
        return $this->item_placement_archive ??= new ItemPlacementArchiveRepository(
            $this->db,
            $this->config->item_placement_archive
        );
    }
    
    public function stockPlacementArchive(): StockPlacementArchiveRepository {
        return $this->stock_placement_archive ??= new StockPlacementArchiveRepository(
            $this->db,
            $this->config->stock_placement_archive
        );
    }
    
    public function rackMovementArchive(): RackMovementArchiveRepository {
        return $this->rack_movement_archive ??= new RackMovementArchiveRepository(
            $this->db,
            $this->config->rack_movement_archive
        );
    }
    
    public function containerMovementArchive(): ContainerMovementArchiveRepository {
        return $this->container_movement_archive ??= new ContainerMovementArchiveRepository(
            $this->db,
            $this->config->container_movement_archive
        );
    }
    
    public function itemMovementArchive(): ItemMovementArchiveRepository {
        return $this->item_movement_archive ??= new ItemMovementArchiveRepository(
            $this->db,
            $this->config->item_movement_archive
        );
    }
    
    public function stockMovementArchive(): StockMovementArchiveRepository {
        return $this->stock_movement_archive ??= new StockMovementArchiveRepository(
            $this->db,
            $this->config->stock_movement_archive
        );
    }
    
    public function itemSalesArchive(): ItemSalesArchiveRepository {
        return $this->item_sales_archive ??= new ItemSalesArchiveRepository(
            $this->db, 
            $this->config->item_sales_archive
        );
    }
    
    public function stockSalesArchive(): StockSalesArchiveRepository {
        return $this->stock_sales_archive ??= new StockSalesArchiveRepository(
            $this->db, 
            $this->config->stock_sales_archive
        );
    }
    
    public function role(): RoleRepository {
        return $this->role ??= new RoleRepository(
            $this->db, 
            $this->config->role
        );
    }
    
    public function provider(): ProviderRepository {
        return $this->provider ??= new ProviderRepository(
            $this->db, 
            $this->config->provider
        );
    }
    
    public function user(): UserRepository {
        return $this->user ??= new UserRepository(
            $this->db, 
            $this->config->user
        );
    }
    
    public function userName(): UserNameRepository {
        return $this->user_name ??= new UserNameRepository(
            $this->db, 
            $this->config->user_name
        );
    }
    
    public function userProcessingStep(): UserProcessingStepRepository {
        return $this->user_processing_step ??= new UserProcessingStepRepository(
            $this->db, 
            $this->config->user_processing_step
        );
    }
    
    public function rackProcessingStep(): RackProcessingStepRepository {
        return $this->rack_processing_step ??= new RackProcessingStepRepository(
            $this->db, 
            $this->config->rack_processing_step
        );
    }
    
    public function userIdentity(): UserIdentityRepository {
        return $this->user_identity ??= new UserIdentityRepository(
            $this->db, 
            $this->config->user_identity
        );
    }
    
    public function owner(): OwnerRepository {
        return $this->owner ??= new OwnerRepository(
            $this->db, 
            $this->config->owner
        );
    }
    
    public function areaAccess(): AreaAccessRepository {
        return $this->area_access ??= new AreaAccessRepository(
            $this->db, 
            $this->config->area_access
        );
    }
}