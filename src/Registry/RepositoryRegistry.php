<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Catalog\VehicleRepository;
use WarehouseCore\Repository\Media\ItemPhotoRepository;
use WarehouseCore\Repository\Media\StockPhotoRepository;
use WarehouseCore\Repository\Media\VehiclePhotoRepository;
use WarehouseCore\Repository\Audit\EventRepository;
use WarehouseCore\Repository\Audit\ItemSalesArhiveRepository;
use WarehouseCore\Repository\Audit\StockSalesArhiveRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;

final class RepositoryRegistry {
    public LocationRepository $location;
    public ContainerPlacementRepository $container_placement;
    public ItemPlacementRepository $item_placement;
    public StockPlacementRepository $stock_placement;
    public ContainerRepository $container;
    public ItemRepository $item;
    public StockRepository $stock;
    public PartRepository $part;
    public VehicleRepository $vehicle;
    public ItemPhotoRepository $item_photo;
    public StockPhotoRepository $stock_photo;
    public VehiclePhotoRepository $vehicle_photo;
    public EventRepository $event;
    public ItemSalesArhiveRepository $item_sales_arhive;
    public StockSalesArhiveRepository $stock_sales_arhive;
    public UserRepository $user;
    public UserIdentityRepository $user_identity;
    public OwnerRepository $owner;
    public PhysicalTagRepository $physical_tag;

    public function __construct(private \PDO $db, mixed $config) {
        $this->location             = new LocationRepository($this->db, $config->location);
        $this->container_placement  = new ContainerPlacementRepository($this->db, $config->container_placement);
        $this->item_placement       = new ItemPlacementRepository($this->db, $config->item_placement);
        $this->stock_placement      = new StockPlacementRepository($this->db, $config->stock_placement);
        $this->container            = new ContainerRepository($this->db, $config->container);
        $this->item                 = new ItemRepository($this->db, $config->item);
        $this->stock                = new StockRepository($this->db, $config->stock);
        $this->part                 = new PartRepository($this->db, $config->part);
        $this->vehicle              = new vehicleRepository($this->db, $config->vehicle);
        $this->item_photo           = new ItemPhotoRepository($this->db, $config->item_photo);
        $this->stock_photo          = new StockPhotoRepository($this->db, $config->stock_photo);
        $this->vehicle_photo        = new VehiclePhotoRepository($this->db, $config->vehicle_photo);
        $this->event                = new EventRepository($this->db, $config->event);
        $this->item_sales_arhive    = new ItemSalesArhiveRepository($this->db, $config->item_sales_archive);
        $this->stock_sales_arhive   = new StockSalesArhiveRepository($this->db, $config->stock_sales_archive);
        $this->user                 = new UserRepository($this->db, $config->user);
        $this->user_identity        = new UserIdentityRepository($this->db, $config->user_identity);
        $this->owner                = new OwnerRepository($this->db, $config->owner);
        $this->physical_tag         = new PhysicalTagRepository($this->db, $config->physical_tag);
    }
}