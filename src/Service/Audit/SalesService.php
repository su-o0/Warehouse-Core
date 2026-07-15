<?php 
namespace WarehouseCore\Service\Audit;

use WarehouseCore\Repository\Audit\ItemSalesArhiveRepository;
use WarehouseCore\Repository\Audit\StockSalesArhiveRepository;
use WarehouseCore\Security\Authorization;

final class SalesService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ItemSalesArhiveRepository $item_sales_arhive_repository,
        private StockSalesArhiveRepository $stock_sales_arhive_repository
    ) { }
}