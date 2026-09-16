<?php
namespace WarehouseCore\Api\Inventory\Container;

use DomainException;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Map\ContainerTypeMapper;
use WarehouseCore\Payload\Request\ValueRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\ContainerService;

final class RegisterContainerApi {
    public function __construct(
        public ApiConfigDTO $config,
        private ContainerService $container_service
    ) { }

    public function handle(
        ValueRequest $request
    ): ApiResult {
        try {
            $container_type = ContainerTypeMapper::match(
                $request->value
            );
        }catch(DomainException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return $this->container_service->registerContainer(
            container_type: $container_type
        );
    }
}