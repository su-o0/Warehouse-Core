<?php
namespace WarehouseCore\Api\Catalog\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Identity\UserService;

final class RemoveUserNameApi {
    public function __construct(
        public string $api_name,
        private UserService $user_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        return $this->user_service->removeUserName(
            user_id: $request->id,
        );
    }
}