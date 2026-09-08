<?php
namespace WarehouseCore\Api\Identity\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Query\GetService;

final class DismissUserRoleApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private UserService $user_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        $result = $this->get_service->getUser(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;
        
        return $this->user_service->dismissUserRole(
            user: $user
        );
    }
}