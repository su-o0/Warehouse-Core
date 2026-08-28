<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Repository\Inventory\ShelfRepository;
use WarehouseCore\Security\Authorization;

final class ShelfService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ShelfRepository $shelf
    ) { }
}