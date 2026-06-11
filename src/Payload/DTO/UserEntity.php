<?php
namespace WarehouseCore\Payload;

use WarehouseCore\Config\ConfigHelper;
class UserEntity {
    use ConfigHelper;

    public function __construct(
        public readonly string $id,
        public readonly string $telegram_id,
        public readonly string $name,
        public readonly string $role_id
    )
    {   }

    public static function fromRaw(array $raw): self {
        return new self(
            self::requiredString($raw, 'id'),
            self::requiredString($raw, 'telegram_id'),
            self::requiredString($raw, 'name'),
            self::requiredString($raw, 'role_id')
        );
    }
}