<?php
namespace WarehouseCore\Api\Topology\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\AreaService;

final class ActivateAreaApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        return $this->area_service->activateArea(
            area_id: $request->id
        );
    }
}