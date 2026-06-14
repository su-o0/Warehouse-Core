<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Payload\DTO\UserEntity;

final class AuthenticationService {
    public function __construct(
        private UserRepository $user
    ) { }

    public function Validate(string $telegram_id): UserEntity|null {
        $user = $this->user->findByTelegramId($telegram_id);
        return empty($user)?null:UserEntity::fromRaw($user);
    }
}