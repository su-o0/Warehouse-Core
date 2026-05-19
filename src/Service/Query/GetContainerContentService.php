<?php 
namespace WarehouseCore\Service\Query;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;

use WarehouseCore\Repository\Catalog\PartRepository;

class GetContainerContentService {
    public function __construct(
        private ContainerRepository $Container,
        private ItemRepository $Item,
        private StockRepository $Stock,
        private PartRepository $Part
    ) {}

    public function execute(int $ContainerId): void {
        echo "Содержимое контейнера $ContainerId\n";
        $ContainerEntity = $this->Container->findById($ContainerId);
        if (!$ContainerEntity) 
            throw new \RuntimeException("Контейнер $ContainerId не найден.");

        $ItemEntitis = $this->Item->findByContainerId($ContainerId);
        $StockEntitis = $this->Stock->findByContainerId($ContainerId);

        foreach ($ItemEntitis as $ItemEntity) {
            $PartEntity = $this->Part->findById($ItemEntity['PartId']);
            echo "- {$PartEntity['Name']} (Кол-во: {$ItemEntity['Quantity']})\n";
        }   
        foreach ($StockEntitis as $StockEntity) {
            $PartEntity = $this->Part->findById($StockEntity['PartId']);
            echo "- {$PartEntity['Name']} (Кол-во: {$StockEntity['Quantity']})\n";
        }
    }
}



