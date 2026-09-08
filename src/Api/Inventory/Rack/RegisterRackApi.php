<?php 
namespace WarehouseCore\Api\Inventory\Rack;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Map\RackTypeMapper;
use WarehouseCore\Payload\Request\ValueRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\RackService;

final class RegisterRackApi {
    public function __construct(
        public string $api_name,
        private RackService $rack_service
    ) { }

    public function handle(
        ValueRequest $request
    ): ApiResult {
        try {
            $rack_type = RackTypeMapper::match(
                $request->value
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