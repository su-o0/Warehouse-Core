<?php 
namespace WarehouseCore\Service\Audit;

use WarehouseCore\Repository\Audit\ItemSalesArhiveRepository;
use WarehouseCore\Repository\Audit\StockSalesArhiveRepository;

final class SalesService {
    public function __construct(
        private ItemSalesArhiveRepository $item_sales_arhive_repository,
        private StockSalesArhiveRepository $stock_sales_arhive_repository
    ) { }
}