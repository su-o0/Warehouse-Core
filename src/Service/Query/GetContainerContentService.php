<?php 
namespace WarehouseCore\Service\Query;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;

use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Payload\Result\ServiceResult;

class GetContainerContentService {
    public function __construct(
        private ContainerRepository $Container,
        private ItemRepository $Item,
        private StockRepository $Stock,
        private PartRepository $Part
    ) {}

    public function execute(int $ContainerId): ServiceResult {
        try {
            $ContainerEntity = $this->Container->findById($ContainerId);
            if (!$ContainerEntity)
                return new ServiceResult(false, null, "Контейнер $ContainerId не найден.");

            $result = ['containerId' => $ContainerId, 'items' => [], 'stocks' => []];

            $ItemEntitis = $this->Item->findByContainerId($ContainerId) ?: [];
            $StockEntitis = $this->Stock->findByContainerId($ContainerId) ?: [];

            foreach ($ItemEntitis as $ItemEntity) {
                $PartEntity = $this->Part->findById($ItemEntity['PartId']);
                $result['items'][] = ['name' => $PartEntity['Name'], 'quantity' => $ItemEntity['Quantity']];
            }
            foreach ($StockEntitis as $StockEntity) {
                $PartEntity = $this->Part->findById($StockEntity['PartId']);
                $result['stocks'][] = ['name' => $PartEntity['Name'], 'quantity' => $StockEntity['Quantity']];
            }

            return new ServiceResult(true, $result, null);
        } catch(\RuntimeException $e) {
            return new ServiceResult(false, null, $e->getMessage());
        }
    }
}



