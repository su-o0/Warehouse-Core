<?php
namespace WarehouseCore\Config;

class DatabaseConfig {
    use ConfigHelper;
    public function __construct(
        public readonly string $host,
        public readonly string $dbname,
        public readonly string $user,
        public readonly string $password,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            self::requiredString($raw, 'host'),
            self::requiredString($raw, 'dbname'),
            self::requiredString($raw, 'user'),
            self::requiredString($raw, 'password')
        );
    }
}