<?php 
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\LocationRepository;
use SuO0\StorageApi\Repository\ContainerRepository;
use SuO0\StorageApi\Repository\StockRepository;
use SuO0\StorageApi\Repository\PartRepository;
use SuO0\StorageApi\Repository\StockPhotoRepository;
use SuO0\StorageApi\Repository\OwnerRepository;

class AddStockScenario {
    public function __Construct(
        private LocationRepository $Location,
        private ContainerRepository $Container,
        private StockRepository $Stock,
        private PartRepository $Part,
        private StockPhotoRepository $StockPhoto,
        private OwnerRepository $Owner
    ) {

    }

    public function execute(int $ContainerId, int $Qcy, string $Article = null):void {
        $Container = $this->Container->findByIdC($ContainerId);

        if(empty($Container))
            throw new \RuntimeException("Контейнер $ContainerId не найден");

        if($Container['Type'] != 'Bulk')
            throw new \RuntimeException("Контейнера должен быть Bulk");

        $Stock = $this->Stock->findByIdC($ContainerId);

        if(!empty($Stock))
            throw new \RuntimeException("Контейнер $ContainerId занят");

        if($Article != null)
            $IdPart = $this->Part->findOrCreate($Article)['Id'];
        else 
            $IdPart = null;

        $this->Stock->add($ContainerId, $Qcy, $IdPart);
        
    }
}