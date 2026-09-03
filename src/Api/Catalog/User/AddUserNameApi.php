<?php
namespace WarehouseCore\Api\Catalog\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityValueRequest;
use WarehouseCore\Service\Identity\UserService;

final class AddUserNameApi {
    public function __construct(
        public string $api_name,
        private UserService $user_service
    ) { }

    public function handle(
        EntityValueRequest $request
    ): ApiResult {
        return $this->user_service->addUserName(
            user_id: $request->id,
            name: $request->value
        );
    }
}