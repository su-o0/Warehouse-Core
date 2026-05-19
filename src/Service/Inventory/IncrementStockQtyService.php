<?php 
namespace WarehouseCore\Service\Inventory;

use WarehouseCore\Repository\Inventory\StockRepository;

class IncrementStockQtyService {

    public function __construct(
        private StockRepository $Stock
    ) { }

    public function execute(int $StockId, int $qty): void {
        $this->Stock->incrementQty($StockId, $qty);
    }
}