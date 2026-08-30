<?php
namespace WarehouseCore\Api\Catalog\Zone;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\RecordRequest;
use WarehouseCore\Service\ZoneService;

final class SetPrimaryZoneNameApi {
    public function __construct(
        public string $api_name,
        private ZoneService $zone_service
    ) { }

    public function handle(
        RecordRequest $request
    ): ApiResult {
        return $this->zone_service->setPrimaryZoneName(
            record_id: $request->record_id,
        );
    }
}