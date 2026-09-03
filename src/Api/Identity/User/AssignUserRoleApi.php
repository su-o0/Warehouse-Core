<?php
namespace WarehouseCore\Api\Identity\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Map\RoleNameMapper;
use WarehouseCore\Payload\Request\EntityValueRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Identity\UserService;

final class AssignUserRoleApi {
    public function __construct(
        public string $api_name,
        private UserService $user_service
    ) { }

    public function handle(
        EntityValueRequest $request
    ): ApiResult {
        try {
            $role = RoleNameMapper::fromString(
                $request->value
            );
        } catch (DomainException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
        
        return $this->user_service->assignUserRole(
            user_id: $request->id,
            role: $role
        );
    }
}