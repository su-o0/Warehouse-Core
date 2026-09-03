<?php
namespace WarehouseCore\Api\Query\List;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Service\Query\ListService;

final class ListUserApi {
    public function __construct(
        public string $api_name,
        private ListService $list_service
    ) { }

    public function handle(
    ): ApiResult {
        return $this->list_service->listUser();
    }
}