<?php 
namespace WarehouseCore\Service\Audit;

use WarehouseCore\Repository\Audit\TelemetryRepository;

final class TelemetryService {
    public function __construct(
        private TelemetryRepository $repository
    ) { }

}