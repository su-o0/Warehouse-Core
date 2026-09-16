<?php
namespace WarehouseCore\Api\Area\Query;

use WarehouseCore\Contract\Api;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\ListService;

final class ListAreaApi implements Api {
    public function __construct(
        public ApiConfigDTO $config,
        private ListService $list_service
    ) { }

    public function handle(
    ): ApiResult {
        return $this->list_service->listArea();
    }
}