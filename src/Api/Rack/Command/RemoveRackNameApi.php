<?php 
namespace WarehouseCore\Api\Rack\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\RackService;

final class RemoveRackNameApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private RackService $rack_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getRack(
            $parameter->id
        );

        if (!$result->success) {
            return $result;
        }

        return $this->rack_service->removeRackName(
            rack: $result->entity
        );
    }
}