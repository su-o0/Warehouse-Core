<?php
namespace WarehouseCore\Api\User\Command;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Identity\UserService;

final class CreateUserApi {
    public function __construct(
        public ApiConfigDTO $config,
        private UserService $user_service
    ) { }

    public function handle(
    ): ApiResult {
        return $this->user_service->createUser();
    }
}