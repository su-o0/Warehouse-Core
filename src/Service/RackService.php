<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Repository\Catalog\RackNameRepository;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Security\Authorization;

final class RackService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private RackRepository $rack,
        private RackNameRepository $rack_name_repository
    ) { }
}