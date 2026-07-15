<?php
namespace WarehouseCore\Api\Identity;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Query\FindService;

final class CreateUser {
    public function __construct(
        public string $api_name,
        private FindService $find,
        private UserService $user,
    ) { }

    public function handle(
        string $name,
        string $role
    ): ServiceResult {
        $result = $this->find->findRoleByName($role);

        if (!$result->success) {
            return $result;
        }

        $role_id = $result->entity->id;
        $result = $this->find->findUserByName($name);
        
        if ($result->success) {
            return new ServiceResult(
                success: false,
                message: DomainException::USER_ALREADY_EXISTS()->getMessage()
            );
        }

        $user = $this->user->create(
            $name,
            $role_id
        );

        return new ServiceResult(
            success: true,
            entity: $user
        );
    }
}