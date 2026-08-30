<?php
namespace WarehouseCore\Api\Topology\Zone;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\ZoneService;

final class MarkZoneAsCrowdedApi {
    public function __construct(
        public string $api_name,
        private ZoneService $zone_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        return $this->zone_service->markZoneAsCrowded(
            zone_id: $request->id
        );
    }
}