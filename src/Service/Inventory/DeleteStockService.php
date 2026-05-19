<?php 
namespace WarehouseCore\Service\Inventory;

use WarehouseCore\Repository\Inventory\StockRepository;

class DeleteStockService {

    public function __construct(
        private StockRepository $Stock) {
    }

    public function execute(int $StockId): void {
        $this->Stock->delete($StockId);
    }
}