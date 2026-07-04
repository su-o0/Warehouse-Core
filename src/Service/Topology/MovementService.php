<?php 
namespace WarehouseCore\Service\Topology;

use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;

final class MovementService {
    public function __construct(
        private LocationRepository $location_repository,
        private ContainerRepository $container_repository,
        private ContainerPlacementRepository $container_placement_repository,
        private ItemRepository $item_repository,
        private ItemPlacementRepository $item_placement_repository,
        private StockRepository $stock_repository,
        private StockPlacementRepository $stock_placement_repository
    ) { }

}
