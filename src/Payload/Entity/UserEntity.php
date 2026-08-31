<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\RoleNameMapper;
use WarehouseCore\Payload\Map\UserStatusMapper;
use WarehouseCore\Payload\Enum\RoleNameEnum;
use WarehouseCore\Payload\Enum\UserStatusEnum;

final readonly class UserEntity {
    use ConfigHelper;

    public function __construct(
        public int $id,
        public ?RoleNameEnum $role,
        public UserStatusEnum $status,
        public string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        $role = self::nullableString($raw, 'role');

        return new self(
            id: self::requiredInt($raw, 'id'),
            role: $role !== null
                ? RoleNameMapper::match($role)
                : null,
            status: UserStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }
}