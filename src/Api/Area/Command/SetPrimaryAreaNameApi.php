<?php
namespace WarehouseCore\Api\Area\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\Api;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;

final class SetPrimaryAreaNameApi implements Api {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private FindService $find_service,
        private AreaService $area_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getArea(
            area_id: $parameter->area_id
        );

        if (!$result->success) {
            return $result;
        }

        $area = $result->entity;

        $result = $this->find_service->findAreaNameByRecordId(
            record_id: $parameter->record_id
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