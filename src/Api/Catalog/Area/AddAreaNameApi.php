<?php
namespace WarehouseCore\Api\Catalog\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Request\EntityValueRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\Query\GetService;

final class AddAreaNameApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private AreaService $area_service
    ) { }

    public function handle(
        EntityValueRequest $request
    ): ApiResult {
        $result = $this->get_service->getArea(
            area_id: $request->id
        );

        if (!$result->success) {
            return $result;
        }

        return $this->area_service->addAreaName(
            area: $result->entity,
            name: $request->value
        );
    }
}