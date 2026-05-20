<?php
namespace WarehouseCore\Bootstrap;
use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\PhysicalTagRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Media\ItemPhotoRepository;
use WarehouseCore\Repository\Media\StockPhotoRepository;
use WarehouseCore\Repository\Media\CarPhotoRepository;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Catalog\CarRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Audit\SalesArhiveRepository;
use WarehouseCore\Repository\Audit\HistoryRepository;
use WarehouseCore\Repository\Audit\OwnerRepository;

class RepositoryRegistry {
    public LocationRepository $Location;
    public ContainerPlacementRepository $ContainerPlacement;
    public ItemPlacementRepository $ItemPlacement;
    public StockPlacementRepository $StockPlacement;
    public ContainerRepository $Container;
    public PhysicalTagRepository $PhysicalTag;
    public ItemRepository $Item;
    public StockRepository $Stock;
    public PartRepository $Part;
    public CarRepository $Car;
    public ItemPhotoRepository $ItemPhoto;
    public StockPhotoRepository $StockPhoto;
    public CarPhotoRepository $CarPhoto;
    public SalesArhiveRepository $SalesArhive;
    public HistoryRepository $History;
    public OwnerRepository $Owner;

    public function __construct(private \PDO $db, array $config) {
        $this->Location             = new LocationRepository($this->db, $config['Location']);
        $this->ContainerPlacement   = new ContainerPlacementRepository($this->db, $config['ContainerPlacement']);
        $this->ItemPlacement        = new ItemPlacementRepository($this->db, $config['ItemPlacement']);
        $this->StockPlacement       = new StockPlacementRepository($this->db, $config['StockPlacement']);
        $this->Container            = new ContainerRepository($this->db, $config['Container']);
        $this->PhysicalTag          = new PhysicalTagRepository($this->db, $config['PhysicalTag']);
        $this->Item                 = new ItemRepository($this->db, $config['Item']);
        $this->Stock                = new StockRepository($this->db, $config['Stock']);
        $this->Part                 = new PartRepository($this->db, $config['Part']);
        $this->Car                  = new CarRepository($this->db, $config['Car']);
        $this->ItemPhoto            = new ItemPhotoRepository($this->db, $config['ItemPhoto']);
        $this->StockPhoto           = new StockPhotoRepository($this->db, $config['StockPhoto']);
        $this->CarPhoto             = new CarPhotoRepository($this->db, $config['CarPhoto']);
        $this->SalesArhive          = new SalesArhiveRepository($this->db, $config['SalesArhive']);
        $this->History              = new HistoryRepository($this->db, $config['History']);
        $this->Owner                = new OwnerRepository($this->db, $config['Owner']);
    }
}