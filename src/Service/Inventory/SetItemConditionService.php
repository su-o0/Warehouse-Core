<?php 
namespace WarehouseCore\Service\Inventory;

use WarehouseCore\Repository\Inventory\ItemRepository;

class SetItemConditionService {

    public function __construct(
        private ItemRepository $Item) {
    }

    public function execute(int $ItemId, string $condition, string $con): void {
        $this->Item->updateCondition($ItemId, $condition);
    }
}