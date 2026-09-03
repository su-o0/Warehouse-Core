<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class UserIdentityRequest {
    use ConfigHelper;
    public function __construct(
        public int $user_id,
        public string $provider
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            user_id: self::requiredInt($raw, 'user_id'),
            provider: self::requiredString($raw, 'provider')
        );
    }
}