<?php 
namespace WarehouseCore\Api\Area\Command;

use WarehouseCore\Contract\Api;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\AreaService;

final class CreateAreaApi implements Api {
    public function __construct(
        public ApiConfigDTO $config,
        private AreaService $area_service
    ) { }

    public function handle(
    ): ApiResult {
        return $this->area_service->createArea();
    }
}