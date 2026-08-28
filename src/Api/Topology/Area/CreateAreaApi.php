<?php 
namespace WarehouseCore\Api\Topology\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Service\AreaService;

final class CreateAreaApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service
    ) { }

    public function handle(
    ): ApiResult {
        return $this->area_service->createArea();
    }
}