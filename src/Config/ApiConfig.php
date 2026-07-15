<?php
namespace WarehouseCore\Config;

final class ApiConfig {
    use ConfigHelper;
    public function __construct(
        public readonly string $create_user,
        public readonly string $create_user_identity,
        public readonly string $create_item,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            create_user: self::requiredString($raw, 'CreateUser'),
            create_user_identity: self::requiredString($raw, 'CreateUserIdentity'),
            create_item: self::requiredString($raw, 'CreateItem'),
        );
    }
}