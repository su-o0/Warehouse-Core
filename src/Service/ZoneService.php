<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Security\Authorization;

final class ZoneService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
    ) { }
}