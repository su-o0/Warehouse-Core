<?php
namespace WarehouseCore\Api\Identity\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Service\Identity\UserService;

final class CreateUserApi {
    public function __construct(
        public string $api_name,
        private UserService $user_service
    ) { }

    public function handle(
    ): ApiResult {
        return $this->user_service->createUser();
    }
}