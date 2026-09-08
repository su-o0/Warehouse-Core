<?php
namespace WarehouseCore\Api\Catalog\Zone;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityValueRequest;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ZoneService;

final class AddZoneNameApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private ZoneService $zone_service
    ) { }

    public function handle(
        EntityValueRequest $request
    ): ApiResult {
        $result = $this->get_service->getZone(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $zone = $result->entity;

        return $this->zone_service->addZoneName(
            zone: $zone,
            name: $request->value
        );
    }
}