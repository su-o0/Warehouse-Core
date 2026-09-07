<?php
namespace WarehouseCore\Api\Catalog\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\Query\GetService;

final class RemoveAreaNameApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private AreaService $area_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        $result = $this->get_service->getArea(
            area_id: $request->id
        );

        if (!$result->success) {
            return $result;
        }

        return $this->area_service->removeAreaName(
            area: $result->entity
        );
    }
}