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
use WarehouseCore\Repository\Inventory\ShelfRepository;
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
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\ProviderRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\AreaAccessRepository;
use WarehouseCore\Repository\Media\StoredFileRepository;

final readonly class RepositoryRegistry {
    public AreaRepository $area;
    public ZoneRepository $zone;
    public RackPlacementRepository $rack_placement;
    public ContainerPlacementRepository $container_placement;
    public ItemPlacementRepository $item_placement;
    public StockPlacementRepository $stock_placement;
    public RackRepository $rack;
    public ShelfRepository $shelf;
    public ContainerRepository $container;
    public ItemRepository $item;
    public StockRepository $stock;
    public PhysicalTagRepository $physical_tag;
    public ItemProcessingStepRepository $item_processing_step;
    public PartProcessingStepRepository $part_processing_step;
    public AreaNameRepository $area_name;
    public ZoneNameRepository $zone_name;
    public RackNameRepository $rack_name;
    public PartRepository $part;
    public PartNumberRepository $part_number;
    public PartNameRepository $part_name;
    public VehicleRepository $vehicle;
    public PartPhotoRepository $part_photo;
    public ItemPhotoRepository $item_photo;
    public StockPhotoRepository $stock_photo;
    public VehiclePhotoRepository $vehicle_photo;
    public PartVideoRepository $part_video;
    public ItemVideoRepository $item_video;
    public StockVideoRepository $stock_video;
    public VehicleVideoRepository $vehicle_video;
    public StoredFileRepository $stored_file; 
    public RackPlacementArchiveRepository $rack_placement_archive;
    public ContainerPlacementArchiveRepository $container_placement_archive;
    public ItemPlacementArchiveRepository $item_placement_archive;
    public StockPlacementArchiveRepository $stock_placement_archive;
    public RackMovementArchiveRepository $rack_movement_archive;
    public ContainerMovementArchiveRepository $container_movement_archive;
    public ItemMovementArchiveRepository $item_movement_archive;
    public StockMovementArchiveRepository $stock_movement_archive;
    public ItemSalesArchiveRepository $item_sales_archive;
    public StockSalesArchiveRepository $stock_sales_archive;
    public RoleRepository $role;
    public ProviderRepository $provider;
    public UserRepository $user;
    public UserIdentityRepository $user_identity;
    public OwnerRepository $owner;
    public AreaAccessRepository $area_access;

    public function __construct(
        RepositoryConfig $config,
        Connection $connection
    ) { 
        $db = $connection->get();

        $this->area = new AreaRepository(
            $db, 
            $config->area
        );

        $this->zone = new ZoneRepository(
            $db, 
            $config->zone
        );

        $this->rack_placement = new RackPlacementRepository(
            $db, 
            $config->rack_placement
        );

        $this->container_placement = new ContainerPlacementRepository(
            $db, 
            $config->container_placement
        );

        $this->item_placement = new ItemPlacementRepository(
            $db, 
            $config->item_placement
        );

        $this->stock_placement = new StockPlacementRepository(
            $db, 
            $config->stock_placement
        );

        $this->rack = new RackRepository(
            $db, 
            $config->rack
        );

        $this->shelf = new ShelfRepository(
            $db, 
            $config->shelf
        );

        $this->container = new ContainerRepository(
            $db, 
            $config->container
        );
        
        $this->item = new ItemRepository(
            $db, 
            $config->item
        );
        
        $this->stock = new StockRepository(
            $db, 
            $config->stock
        );
        
        $this->physical_tag = new PhysicalTagRepository(
            $db, 
            $config->physical_tag
        );

        $this->item_processing_step = new ItemProcessingStepRepository(
            $db,
            $config->item_processing_step
        );
        
        $this->part_processing_step = new PartProcessingStepRepository(
            $db,
            $config->part_processing_step
        );

        $this->area_name = new AreaNameRepository(
            $db,
            $config->area_name
        );

        $this->zone_name = new ZoneNameRepository(
            $db,
            $config->zone_name
        );

        $this->rack_name = new RackNameRepository(
            $db,
            $config->rack_name
        );

        $this->part = new PartRepository(
            $db, 
            $config->part
        );
        
        $this->part_number = new PartNumberRepository(
            $db, 
            $config->part_number
        );

        $this->part_name = new PartNameRepository(
            $db, 
            $config->part_name
        );

        $this->vehicle = new VehicleRepository(
            $db, 
            $config->vehicle
        );

        $this->part_photo = new PartPhotoRepository(
            $db,
            $config->part_photo
        );
        
        $this->item_photo = new ItemPhotoRepository(
            $db, 
            $config->item_photo
        );
        
        $this->stock_photo = new StockPhotoRepository(
            $db, 
            $config->stock_photo
        );
        
        $this->vehicle_photo = new VehiclePhotoRepository(
            $db, 
            $config->vehicle_photo
        );

        $this->part_video = new PartVideoRepository(
            $db,
            $config->part_video
        );

        $this->item_video = new ItemVideoRepository(
            $db, 
            $config->item_video
        );
        
        $this->stock_video = new StockVideoRepository(
            $db, 
            $config->stock_video
        );

        $this->vehicle_video = new VehicleVideoRepository(
            $db, 
            $config->vehicle_photo
        );
        
        $this->stored_file = new StoredFileRepository(
            $db,
            $config->stored_file
        );

        $this->rack_placement_archive = new RackPlacementArchiveRepository(
            $db,
            $config->rack_placement_archive
        );
      
        $this->container_placement_archive = new ContainerPlacementArchiveRepository(
            $db,
            $config->container_placement_archive
        );

        $this->item_placement_archive = new ItemPlacementArchiveRepository(
            $db,
            $config->item_placement_archive
        );

        $this->stock_placement_archive = new StockPlacementArchiveRepository(
            $db,
            $config->stock_placement_archive
        );

        $this->rack_movement_archive = new RackMovementArchiveRepository(
            $db,
            $config->rack_movement_archive
        );

        $this->container_movement_archive = new ContainerMovementArchiveRepository(
            $db,
            $config->container_movement_archive
        );

        $this->item_movement_archive = new ItemMovementArchiveRepository(
            $db,
            $config->item_movement_archive
        );

        $this->stock_movement_archive = new StockMovementArchiveRepository(
            $db,
            $config->stock_movement_archive
        );
        
        $this->item_sales_archive = new ItemSalesArchiveRepository(
            $db, 
            $config->item_sales_archive
        );
        
        $this->stock_sales_archive = new StockSalesArchiveRepository(
            $db, 
            $config->stock_sales_archive
        );

        $this->role = new RoleRepository(
            $db, 
            $config->role
        );

        $this->provider = new ProviderRepository(
            $db, 
            $config->provider
        );

        $this->user = new UserRepository(
            $db, 
            $config->user
        );
        
        $this->user_identity = new UserIdentityRepository(
            $db, 
            $config->user_identity
        );
        
        $this->owner = new OwnerRepository(
            $db, 
            $config->owner
        );

        $this->area_access = new AreaAccessRepository(
            $db, 
            $config->area_access
        );
    }
}