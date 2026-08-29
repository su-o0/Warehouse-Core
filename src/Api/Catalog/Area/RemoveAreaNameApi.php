<?php
namespace WarehouseCore\Api\Catalog\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\AreaService;

final class RemoveAreaNameApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        return $this->area_service->removeAreaName(
            area_id: $request->id,
        );
    }
}