<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

class UserEntity {
    use ConfigHelper;

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $role_id,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::required($raw, 'id'),
            name: self::requiredString($raw, 'name'),
            role_id: self::required($raw, 'role_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }
}