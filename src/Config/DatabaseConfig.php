<?php
namespace WarehouseCore\Config;

use WarehouseCore\Contract\Config;

final readonly class DatabaseConfig implements Config {
    use ConfigHelper;
    public function __construct(
        public string $driver,
        public string $host,
        public string $dbname,
        public string $user,
        public string $password,
        public string $charset
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            self::requiredString($raw, 'driver'),
            self::requiredString($raw, 'host'),
            self::requiredString($raw, 'dbname'),
            self::requiredString($raw, 'user'),
            self::requiredString($raw, 'password'),
            self::requiredString($raw, 'charset')
        );
    }
}