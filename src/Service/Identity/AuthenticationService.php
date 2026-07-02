<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Payload\DTO\UserEntity;
use WarehouseCore\Payload\DTO\UserIdentityEntity;

final class AuthenticationService {
    public function __construct(
        private UserRepository $user,
        private UserIdentityRepository $user_identity
    ) { }

    public function Validate(
        string $provider,
        string $external_id
    ): UserEntity|null {
        $user_identity = $this->user_identity->findByIdentity($provider, $external_id);
        if (empty($user)) {
            return null;
        }
        $user_identity_entity = UserIdentityEntity::fromRaw($user_identity);

        $user = $this->user->findById($user_identity_entity->user_id);
        if (empty($user)) {
            return null;
        }

        return UserEntity::fromRaw($user);
    }
}