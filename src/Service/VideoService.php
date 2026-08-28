<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Security\Authorization;

final class VideoService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
    ) { }
}