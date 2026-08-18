<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\ProviderNameEnum;
use WarehouseCore\Payload\Map\ProviderNameMapper;

final class UserIdentityEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public int $user_id,
        public ProviderNameEnum $provider,
        public string $external_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            user_id: self::requiredInt($raw, 'user_id'),
            provider: ProviderNameMapper::match(
                self::requiredString($raw, 'provider')
            ),
            external_id: self::requiredString($raw, 'external_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
    
}