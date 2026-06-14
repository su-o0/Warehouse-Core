<?php
namespace WarehouseCore\Payload\DTO;

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
        error_log(var_export($raw, true));
        return new self(
            self::required($raw, 'id'),
            self::requiredString($raw, 'telegram_id'),
            self::requiredString($raw, 'name'),
            self::required($raw, 'role_id')
        );
    }
}