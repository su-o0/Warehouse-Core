<?php
namespace WarehouseCore\Api\Area\Query;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\Api;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Query\ListService;

final class ListAreaNamesApi implements Api {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private ListService $list_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getArea(
            $parameter->area_id
        );

        if (!$result->success) {
            return $result;
        }

        return $this->list_service->listAreaNames(
            area: $result->entity
        );
    }
}