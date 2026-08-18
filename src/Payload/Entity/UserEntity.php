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
        public string $name,
        public RoleNameEnum $role,
        public UserStatusEnum $status,
        public string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            name: self::requiredString($raw, 'name'),
            role: RoleNameMapper::match(
                self::requiredInt($raw, 'role_id')
            ),
            status: UserStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }
}