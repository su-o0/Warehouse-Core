<?php
namespace WarehouseCore\Api\Catalog\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\RecordRequest;
use WarehouseCore\Service\AreaService;

final class SetPrimaryAreaNameApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service
    ) { }

    public function handle(
        RecordRequest $request
    ): ApiResult {
        return $this->area_service->setPrimaryAreaName(
            record_id: $request->record_id,
        );
    }
}