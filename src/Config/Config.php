<?php
namespace WarehouseCore\Config;

class Config {
    use ConfigHelper;
    public function __construct(
        public DatabaseConfig $db,
        public TableConfig $tables
    ) { }

    public static function prepare(array $raw): self {
        return new self(
            db: DatabaseConfig::fromRaw(self::required($raw, 'database')),
            tables: TableConfig::fromRaw(self::required($raw, 'tables')),
        );
    }
}