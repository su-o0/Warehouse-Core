<?php
namespace WarehouseCore\Api\Identity;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Request\CreateUserRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Query\FindService;

final class CreateUserApi {
    public function __construct(
        public string $api_name,
        private FindService $find,
        private UserService $user,
    ) { }

    public function handle(
        CreateUserRequest $request
    ): ServiceResult {
        $result = $this->find->findRoleByName($request->role->value);

        if(!$result->success) {
            return $result;
        }

        if($result->entity === null) {
            return $result;
        }

        $role_id = $result->entity->id;
        $result = $this->find->findUserByName($request->name);
        
        if ($result->success) {
            return new ServiceResult(
                success: false,
                message: DomainException::USER_ALREADY_EXISTS()->getMessage()
            );
        }

        $user = $this->user->create(
            $request->name,
            $role_id
        );

        return new ServiceResult(
            success: true,
            entity: $user
        );
    }
}