<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

class OwnerEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly int $user_id,
        public readonly string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        error_log(var_export($raw, true));
        return new self(
            id: self::required($raw, 'id'),
            user_id: self::requiredString($raw, 'user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}