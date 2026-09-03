<?php
namespace WarehouseCore\Api\Identity\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Identity\UserService;

final class ArchiveUserApi {
    public function __construct(
        public string $api_name,
        private UserService $user_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        return $this->user_service->archiveUser(
            user_id: $request->id
        );
    }
}