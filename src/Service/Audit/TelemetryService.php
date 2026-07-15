<?php 
namespace WarehouseCore\Service\Audit;

use WarehouseCore\Repository\Audit\TelemetryRepository;
use WarehouseCore\Security\Authorization;

final class TelemetryService {
    public function __construct(
        public string $service_name,
        private TelemetryRepository $repository
    ) { }

}