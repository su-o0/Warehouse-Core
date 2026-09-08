<?php
namespace WarehouseCore\Api\Catalog\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRecordRequest;
use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;

final class SetPrimaryAreaNameApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private FindService $find_service,
        private AreaService $area_service
    ) { }

    public function handle(
        EntityRecordRequest $request
    ): ApiResult {
        $result = $this->get_service->getArea(
            area_id: $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $area = $result->entity;

        $result = $this->find_service->findAreaNameByRecordId(
            record_id: $request->record_id
        );

        if (!$result->success) {
            return $result;
        }
        
        $area_name = $result->entity;

        return $this->area_service->setPrimaryAreaName(
            area: $area,
            area_name: $area_name
        );
    }
}