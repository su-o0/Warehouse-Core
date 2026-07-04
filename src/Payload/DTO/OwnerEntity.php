<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
class OwnerEntity {
    use ConfigHelper;

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $user_id,
        public readonly string $created_at
    )
    {   }

    public static function fromRaw(array $raw): self {
        error_log(var_export($raw, true));
        return new self(
            id: self::required($raw, 'id'),
            name: self::requiredString($raw, 'name'),
            user_id: self::requiredString($raw, 'user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}