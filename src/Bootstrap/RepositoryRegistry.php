<?php
namespace WarehouseCore\Bootstrap;

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
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;

class RepositoryRegistry {
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
    public OwnerRepository $owner;
    public PhysicalTagRepository $physical_tag;

    public function __construct(private \PDO $db, array $config) {
        $this->location             = new LocationRepository($this->db, $config['Location']);
        $this->container_placement  = new ContainerPlacementRepository($this->db, $config['ContainerPlacement']);
        $this->item_placement       = new ItemPlacementRepository($this->db, $config['ItemPlacement']);
        $this->stock_placement      = new StockPlacementRepository($this->db, $config['StockPlacement']);
        $this->container            = new ContainerRepository($this->db, $config['Container']);
        $this->item                 = new ItemRepository($this->db, $config['Item']);
        $this->stock                = new StockRepository($this->db, $config['Stock']);
        $this->part                 = new PartRepository($this->db, $config['Part']);
        $this->vehicle              = new vehicleRepository($this->db, $config['vehicle']);
        $this->item_photo           = new ItemPhotoRepository($this->db, $config['ItemPhoto']);
        $this->stock_photo          = new StockPhotoRepository($this->db, $config['StockPhoto']);
        $this->vehicle_photo        = new VehiclePhotoRepository($this->db, $config['VehiclePhoto']);
        $this->item_sales_arhive    = new ItemSalesArhiveRepository($this->db, $config['ItemSalesArhive']);
        $this->stock_sales_arhive   = new StockSalesArhiveRepository($this->db, $config['StockSalesArhive']);
        $this->user                 = new UserRepository($this->db, $config['User']);
        $this->owner                = new OwnerRepository($this->db, $config['Owner']);
        $this->physical_tag         = new PhysicalTagRepository($this->db, $config['PhysicalTag']);
    }
}