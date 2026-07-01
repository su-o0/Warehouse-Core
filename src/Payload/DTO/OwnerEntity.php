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
            self::required($raw, 'id'),
            self::requiredString($raw, 'name'),
            self::requiredString($raw, 'user_id'),
            self::required($raw, 'created_at')
        );
    }
}