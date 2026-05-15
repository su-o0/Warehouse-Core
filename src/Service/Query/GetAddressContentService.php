<?php
namespace SuO0\StorageApi\Service\Query;
use SuO0\StorageApi\Repository\Topology\LocationRepository;
use SuO0\StorageApi\Repository\Topology\ContainerPlacementRepository;
use SuO0\StorageApi\Repository\Topology\ItemPlacementRepository;
use SuO0\StorageApi\Repository\Topology\StockPlacementRepository;

use SuO0\StorageApi\Repository\Inventory\ItemRepository;
use SuO0\StorageApi\Repository\Inventory\StockRepository;
use SuO0\StorageApi\Repository\Catalog\PartRepository;


class GetAddressContentService {
    public function __construct(
        public LocationRepository $Location,
        public ContainerPlacementRepository $ContainerPlacement,
        public ItemPlacementRepository $ItemPlacement,
        public StockPlacementRepository $StockPlacement,
        public ItemRepository $Item,
        public StockRepository $Stock,
        public PartRepository $Part
        ) {
    }

    public function execute(string $Address): void {
        echo "Получение содержимого адреса $Address\n";
        $Location = $this->Location->findByAddress($Address);
        if($Location === null)
            throw new \RuntimeException("Адрес $Address не найден");

        $ContainerPlacements = $this->ContainerPlacement->findByLocationId($Location['Id']);
        $ItemPlacements = $this->ItemPlacement->findByLocationId($Location['Id']);
        $StockPlacements = $this->StockPlacement->findByLocationId($Location['Id']);

        if($ContainerPlacements !== null) {
            echo "Контейнеры на адресе:\n";
            foreach($ContainerPlacements as $ContainerPlacement) {
                echo "\t- Контейнер " . $ContainerPlacement['ContainerId'] . "\n";
                $StocksInContainer = $this->Stock->findByContainerId($ContainerPlacement['ContainerId']);
                if($StocksInContainer !== null) {
                    foreach($StocksInContainer as $StockPlacement) {
                        echo "\t\tСток " . $this->Part->findById($StockPlacement['StockId'])['Article'] . "\n";
                        echo "\t\tКоличество: " . $StockPlacement['Qty'] . "\n";
                    }
                }
                
                
                $ItemPlacementsInContainer = $this->Item->findByContainerId($ContainerPlacement['ContainerId']);
                if($ItemPlacementsInContainer !== null) {
                    echo "\tПредметы:\n";
                    foreach($ItemPlacementsInContainer as $ItemPlacement) {
                        echo " - Предмет " . $this->Part->findById($ItemPlacement['ItemId'])['Article'] . "\n";
                    }
                }
            }
        }
        if($ItemPlacements !== null) {
            echo "Предметы на адресе:\n";
            foreach($ItemPlacements as $ItemPlacement) {
                echo " - Предмет " . $this->Part->findById($ItemPlacement['ItemId'])['Article'] . "\n";    
            }
        }
        if($StockPlacements !== null) {
            echo "Стоки на адресе:\n";
            foreach($StockPlacements as $StockPlacement) {
                $Stock = $this->Stock->findById($StockPlacement['StockId']);
                echo " - Сток " . $this->Part->findById($Stock['PartId'])['Article'] . " - Количество: " . $Stock['Qty'] . "\n";
            }
        }
        

    }

}