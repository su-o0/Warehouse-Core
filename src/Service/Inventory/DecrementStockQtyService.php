<?php 
namespace WarehouseCore\Service\Inventory;

use WarehouseCore\Repository\Inventory\StockRepository;

class DecrementStockQtyService {

    public function __construct(
        private StockRepository $Stock) {
    }

    public function execute(int $StockId, int $qty): void {
        $this->Stock->decrementQty($StockId, $qty);
    }
}