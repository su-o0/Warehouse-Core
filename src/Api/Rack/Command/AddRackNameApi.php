<?php
namespace WarehouseCore\Api\Rack\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\Api;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\RackService;
use WarehouseCore\Service\Query\GetService;

final class AddRackNameApi implements Api {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private RackService $rack_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getRack(
            rack_id: $parameter->area_id
        );

        if (!$result->success) {
            return $result;
        }

        return $this->rack_service->addRackName(
            rack: $result->entity,
            name: $parameter->name
        );
    }
}