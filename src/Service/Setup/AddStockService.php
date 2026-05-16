<?php 
namespace StorageApi\Service\Setup;
use StorageApi\Repository\Topology\LocationRepository;
use StorageApi\Repository\Topology\StockPlacementRepository;
use StorageApi\Repository\Inventory\StockRepository;
use StorageApi\Repository\Catalog\PartRepository;

class AddStockService {
    public function __Construct(
        private LocationRepository $Location,
        private StockPlacementRepository $StockPlacement,
        private StockRepository $Stock,
        private PartRepository $Part    
    ) { }

    public function execute(string $Address, int $Qcy, ?string $Article = null):void {
        echo "Добавление стока по адресу $Address\n";

        $Location = $this->Location->findByAddress($Address);
        if($Location === null)
            throw new \RuntimeException("Адресс $Address не существует");

        $Part = ($Article === null) ? null : $this->Part->findOrCreate($Article);

        // $Stock = $this->Stock->findByPartId($Part['Id']);
        // if($Stock !== null)
        //     throw new \RuntimeException("Асортимент с артикулом $Article уже существует");    
        
        $StockId = $this->Stock->add($Qcy, $Part['Id'] ?? null);

        $this->StockPlacement->add($Location['Id'], $StockId);

        echo "Сток $StockId добавлен по адресу $Address\n";
    }
}