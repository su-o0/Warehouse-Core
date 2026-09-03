<?php
namespace WarehouseCore\Api\Catalog\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityValueRequest;
use WarehouseCore\Service\AreaService;

final class AddAreaNameApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service
    ) { }

    public function handle(
        EntityValueRequest $request
    ): ApiResult {
        return $this->area_service->addAreaName(
            area_id: $request->id,
            name: $request->value
        );
    }
}