<?php 
namespace WarehouseCore\Api\Inventory\Rack;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Service\RackService;

final class RegisterRackApi {
    public function __construct(
        public string $api_name,
        private RackService $rack_service
    ) { }

    public function handle(): ApiResult {
        return $this->rack_service->registerRack();
    }
}