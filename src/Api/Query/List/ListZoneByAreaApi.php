<?php
namespace WarehouseCore\Api\Query\List;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Query\ListService;

final class ListZoneByAreaApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private ListService $list_service
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

        return $this->list_service->listZoneByArea(
            area: $area 
        );
    }
}