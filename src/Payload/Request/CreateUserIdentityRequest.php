<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ProviderTypeMapper;
use WarehouseCore\Payload\Type\ProviderType;

final class CreateUserIdentityRequest {
    use ConfigHelper;
    public function __construct(
        public int $user_id,
        public ProviderType $provider,
        public string $external_id,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            user_id: self::requiredInt($raw, 'name'),
            provider: ProviderTypeMapper::fromString(
                self::requiredString($raw, 'role')
            ),
            external_id: self::requiredString($raw, 'external_id')
        );
    }
}