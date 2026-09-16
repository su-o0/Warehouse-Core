<?php
namespace WarehouseCore\Api\User\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Query\GetService;

final class AssignUserRoleApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private UserService $user_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getRole(
            $parameter->value
        );

        if (!$result->success) {
            return $result;
        }

        $role = $result->entity->name;

        $result = $this->get_service->getUser(
            $parameter->id
        );

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;
        
        return $this->user_service->assignUserRole(
            user: $user,
            role: $role
        );
    }
}