<?php 
namespace WarehouseCore\Api\Topology\Zone;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ZoneService;

final class CreateZoneApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private ZoneService $zone_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        $result = $this->get_service->getArea(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $area = $result->entity;

        return $this->zone_service->createZone(
            area: $area
        );
    }
}