<?php
namespace WarehouseCore\Service\Query;

use WarehouseCore\Security\Authorization;

final class ListService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
    ) { }
}