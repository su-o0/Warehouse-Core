<?php
namespace WarehouseCore\Api\Topology\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\AreaRequest;
use WarehouseCore\Service\AreaService;

final class MarkAreaAsCrowdedApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service
    ) { }

    public function handle(
        AreaRequest $request
    ): ApiResult {
        return $this->area_service->markAreaAsCrowded(
            $request->area_id
        );
    }
}