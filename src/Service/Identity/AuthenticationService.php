<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Payload\UserEntity;

final class AuthenticationService {
    public function __construct(
        private UserRepository $user
    ) { }

    public function Validate(string $user_id): UserEntity|null {
        $user = $this->user->findById($user_id);

        if(empty($user)) 
            return null;

        return UserEntity::fromRaw($user);
    }
}