<?php
namespace SuO0\StorageApi\Service\Placement;

use SuO0\StorageApi\Repository\Topology\ContainerPlacementRepository;
use SuO0\StorageApi\Repository\Topology\StockPlacementRepository;

use SuO0\StorageApi\Repository\Inventory\ContainerRepository;
use SuO0\StorageApi\Repository\Inventory\StockRepository;

class PlaceStockToContainerService {
    public function __construct(
        private ContainerPlacementRepository $ContainerPlacement,
        private StockPlacementRepository $StockPlacement,
        private ContainerRepository $Container,
        private StockRepository $Stock
    ) {}

    public function execute(int $StockId, int $ContainerId): void {
        $StockEntity = $this->Stock->findById($StockId);
        if($StockEntity === null)
            throw new \RuntimeException("Сток $StockId не найден");

        $StockPlacementEntity = $this->StockPlacement->findByStockId($StockId);
        if($StockPlacementEntity === null)
            throw new \RuntimeException("Сток $StockId не размещен");
        
        $ContainerEntity = $this->Container->findById($ContainerId);
        if($ContainerEntity === null)
            throw new \RuntimeException("Контейнер $ContainerId не найден");

        $ContainerPlacementEntity = $this->ContainerPlacement->findByContainerId($ContainerId);
        if($ContainerPlacementEntity === null)
            throw new \RuntimeException("Контейнер $ContainerId не размещен");

        
        $this->StockPlacement->delete($StockPlacementEntity['Id']);
        $this->Stock->updateContainerId($StockEntity['Id'], $ContainerId);
        echo "Сток $StockId успешно размещен в контейнер $ContainerId\n";
    }
}