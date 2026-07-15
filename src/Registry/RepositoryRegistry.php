<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\RepositoryConfig;
use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Processing\ItemProcessingStepRepository;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Catalog\PartAliasRepository;
use WarehouseCore\Repository\Catalog\VehicleRepository;
use WarehouseCore\Repository\Media\ItemPhotoRepository;
use WarehouseCore\Repository\Media\StockPhotoRepository;
use WarehouseCore\Repository\Media\VehiclePhotoRepository;
use WarehouseCore\Repository\Audit\TelemetryRepository;
use WarehouseCore\Repository\Audit\ItemSalesArhiveRepository;
use WarehouseCore\Repository\Audit\StockSalesArhiveRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;
use WarehouseCore\Repository\Media\PartPhotoRepository;
use WarehouseCore\Repository\Media\StorageFileRepository;

final class RepositoryRegistry {
    public readonly LocationRepository $location;
    public readonly ContainerPlacementRepository $container_placement;
    public readonly ItemPlacementRepository $item_placement;
    public readonly StockPlacementRepository $stock_placement;
    public readonly ContainerRepository $container;
    public readonly ItemRepository $item;
    public readonly StockRepository $stock;
    public readonly ItemProcessingStepRepository $item_processing_step;
    public readonly PartRepository $part;
    public readonly PartAliasRepository $part_alias;
    public readonly VehicleRepository $vehicle;
    public readonly StorageFileRepository $storage_file;
    public readonly PartPhotoRepository $part_photo;
    public readonly ItemPhotoRepository $item_photo;
    public readonly StockPhotoRepository $stock_photo;
    public readonly VehiclePhotoRepository $vehicle_photo;
    public readonly TelemetryRepository $telemetry;
    public readonly ItemSalesArhiveRepository $item_sales_arhive;
    public readonly StockSalesArhiveRepository $stock_sales_arhive;
    public readonly RoleRepository $role;
    public readonly UserRepository $user;
    public readonly UserIdentityRepository $user_identity;
    public readonly OwnerRepository $owner;
    public readonly PhysicalTagRepository $physical_tag;

    public function __construct(
        private \PDO $db, 
        RepositoryConfig $config
    ) {
        $this->location = new LocationRepository(
            $this->db, 
            $config->location
        );
        
        $this->container_placement = new ContainerPlacementRepository(
            $this->db, 
            $config->container_placement
        );

        $this->item_placement = new ItemPlacementRepository(
            $this->db, 
            $config->item_placement
        );

        $this->stock_placement = new StockPlacementRepository(
            $this->db, 
            $config->stock_placement
        );
        
        $this->container = new ContainerRepository(
            $this->db, 
            $config->container
        );
        
        $this->item = new ItemRepository(
            $this->db, 
            $config->item
        );
        
        $this->stock = new StockRepository(
            $this->db, 
            $config->stock
        );
        
        $this->item_processing_step = new ItemProcessingStepRepository(
            $this->db,
            $config->item_processing_step
        );
        
        $this->part = new PartRepository(
            $this->db, 
            $config->part
        );
        
        $this->part_alias = new PartAliasRepository(
            $this->db, 
            $config->part_alias
        );

        $this->vehicle = new VehicleRepository(
            $this->db, 
            $config->vehicle
        );

        $this->storage_file = new StorageFileRepository(
            $this->db,
            $config->stored_file
        );

        $this->part_photo = new PartPhotoRepository(
            $this->db,
            $config->part_photo
        );
        
        $this->item_photo = new ItemPhotoRepository(
            $this->db, 
            $config->item_photo
        );
        
        $this->stock_photo = new StockPhotoRepository(
            $this->db, 
            $config->stock_photo
        );
        
        $this->vehicle_photo = new VehiclePhotoRepository(
            $this->db, 
            $config->vehicle_photo
        );
        
        $this->telemetry = new TelemetryRepository(
            $this->db, 
            $config->telemetry
        );
        
        $this->item_sales_arhive = new ItemSalesArhiveRepository(
            $this->db, 
            $config->item_sales_archive
        );
        
        $this->stock_sales_arhive = new StockSalesArhiveRepository(
            $this->db, 
            $config->stock_sales_archive
        );

        $this->role = new RoleRepository(
            $this->db, 
            $config->role
        );

        $this->user = new UserRepository(
            $this->db, 
            $config->user
        );
        
        $this->user_identity = new UserIdentityRepository(
            $this->db, 
            $config->user_identity
        );
        
        $this->owner = new OwnerRepository(
            $this->db, 
            $config->owner
        );
        
        $this->physical_tag = new PhysicalTagRepository(
            $this->db, 
            $config->physical_tag
        );
    }
}