<?php
namespace SuO0\StorageApi\Bootstrap;

use SuO0\StorageApi\Repository\LocationRepository;
use SuO0\StorageApi\Repository\PlacementRepository;
use SuO0\StorageApi\Repository\ContainerRepository;
use SuO0\StorageApi\Repository\PhysicalTagRepository;
use SuO0\StorageApi\Repository\ItemRepository;
use SuO0\StorageApi\Repository\StockRepository;
use SuO0\StorageApi\Repository\PartRepository;
use SuO0\StorageApi\Repository\CarRepository;
use SuO0\StorageApi\Repository\ItemPhotoRepository;
use SuO0\StorageApi\Repository\StockPhotoRepository;
use SuO0\StorageApi\Repository\CarPhotoRepository;
use SuO0\StorageApi\Repository\SalesArhiveRepository;
use SuO0\StorageApi\Repository\HistoryRepository;
use SuO0\StorageApi\Repository\OwnerRepository;

class SetupRepository {
    public LocationRepository $Location;
    public PlacementRepository $Placement;
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
        $this->Location     = new LocationRepository($this->db, $config['Location']);
        $this->Placement    = new PlacementRepository($this->db, $config['Placement']);
        $this->Container    = new ContainerRepository($this->db, $config['Container']);
        $this->PhysicalTag  = new PhysicalTagRepository($this->db, $config['PhysicalTag']);
        $this->Item         = new ItemRepository($this->db, $config['Item']);
        $this->Stock        = new StockRepository($this->db, $config['Stock']);
        $this->Part         = new PartRepository($this->db, $config['Part']);
        $this->Car          = new CarRepository($this->db, $config['Car']);
        $this->ItemPhoto    = new ItemPhotoRepository($this->db, $config['ItemPhoto']);
        $this->StockPhoto   = new StockPhotoRepository($this->db, $config['StockPhoto']);
        $this->CarPhoto     = new CarPhotoRepository($this->db, $config['CarPhoto']);
        $this->SalesArhive  = new SalesArhiveRepository($this->db, $config['SalesArhive']);
        $this->History      = new HistoryRepository($this->db, $config['History']);
        $this->Owner        = new OwnerRepository($this->db, $config['Owner']);
    }
}