<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

final class UserIdentityEntity {
    use ConfigHelper;
    public function __construct(
        public int $user_id,
        public string $provider,
        public string $external_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            user_id: self::requiredInt($raw, 'user_id'),
            provider: self::requiredString($raw, 'provider'),
            external_id: self::requiredString($raw, 'external_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
    
}