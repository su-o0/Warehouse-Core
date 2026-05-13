<?php
namespace SuO0\StorageApi\Bootstrap;

use SuO0\StorageApi\Repository\Topology\LocationRepository;
use SuO0\StorageApi\Repository\Topology\PhysicalTagRepository;
use SuO0\StorageApi\Repository\Topology\ContainerPlacementRepository;
use SuO0\StorageApi\Repository\Topology\ItemPlacementRepository;
use SuO0\StorageApi\Repository\Topology\StockPlacementRepository;

use SuO0\StorageApi\Repository\Media\ItemPhotoRepository;
use SuO0\StorageApi\Repository\Media\StockPhotoRepository;
use SuO0\StorageApi\Repository\Media\CarPhotoRepository;

use SuO0\StorageApi\Repository\Catalog\PartRepository;
use SuO0\StorageApi\Repository\Catalog\CarRepository;

use SuO0\StorageApi\Repository\Inventory\ContainerRepository;
use SuO0\StorageApi\Repository\Inventory\ItemRepository;
use SuO0\StorageApi\Repository\Inventory\StockRepository;

use SuO0\StorageApi\Repository\Audit\SalesArhiveRepository;
use SuO0\StorageApi\Repository\Audit\HistoryRepository;
use SuO0\StorageApi\Repository\Audit\OwnerRepository;

class SetupRepository {
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