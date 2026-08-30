<?php
namespace WarehouseCore\Api\Catalog\Zone;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\ValueNameRequest;
use WarehouseCore\Service\ZoneService;

final class AddZoneNameApi {
    public function __construct(
        public string $api_name,
        private ZoneService $zone_service
    ) { }

    public function handle(
        ValueNameRequest $request
    ): ApiResult {
        return $this->zone_service->addZoneName(
            zone_id: $request->id,
            name: $request->name
        );
    }
}