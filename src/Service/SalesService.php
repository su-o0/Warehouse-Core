<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Repository\Audit\ItemSalesArchiveRepository;
use WarehouseCore\Repository\Audit\StockSalesArchiveRepository;
use WarehouseCore\Security\Authorization;

final class SalesService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ItemSalesArchiveRepository $item_sales_archive,
        private StockSalesArchiveRepository $stock_sales_archive
    ) { }
}