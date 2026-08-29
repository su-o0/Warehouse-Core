<?php
namespace WarehouseCore\Api\Topology\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\AreaService;

final class ArchiveAreaApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        return $this->area_service->archiveArea(
            area_id: $request->id
        );
    }
}