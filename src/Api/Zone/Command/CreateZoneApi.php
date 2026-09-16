<?php 
namespace WarehouseCore\Api\Zone\Command;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\ZoneService;

final class CreateZoneApi {
    public function __construct(
        public ApiConfigDTO $config,
        private ZoneService $zone_service
    ) { }

    public function handle(): ApiResult {
        return $this->zone_service->createZone();
    }
}