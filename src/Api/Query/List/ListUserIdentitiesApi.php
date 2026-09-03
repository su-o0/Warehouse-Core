<?php
namespace WarehouseCore\Api\Query\List;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Query\ListService;

final class ListUserIdentitiesApi {
    public function __construct(
        public string $api_name,
        private ListService $list_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        return $this->list_service->listUserIdentities(
            user_id: $request->id
        );
    }
}