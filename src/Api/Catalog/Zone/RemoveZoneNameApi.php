<?php
namespace WarehouseCore\Api\Catalog\Zone;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\ZoneService;

final class RemoveZoneNameApi {
    public function __construct(
        public string $api_name,
        private ZoneService $zone_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        return $this->zone_service->removeZoneName(
            zone_id: $request->id,
        );
    }
}