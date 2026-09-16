<?php
namespace WarehouseCore\Api\Zone\Query;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\ListService;

final class ListZoneApi {
    public function __construct(
        public ApiConfigDTO $config,
        private ListService $list_service
    ) { }

    public function handle(
    ): ApiResult {
        return $this->list_service->listZone();
    }
}