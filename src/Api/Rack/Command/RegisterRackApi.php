<?php 
namespace WarehouseCore\Api\Rack\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Payload\Map\RackTypeMapper;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\RackService;

final class RegisterRackApi {
    public function __construct(
        public ApiConfigDTO $config,
        private RackService $rack_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        try {
            $rack_type = RackTypeMapper::match(
                $parameter->rack_type
            );
        }catch(DomainException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return $this->rack_service->registerRack(
            rack_type: $rack_type
        );
    }
}