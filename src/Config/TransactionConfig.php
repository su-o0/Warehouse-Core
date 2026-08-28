<?php
namespace WarehouseCore\Config;

final readonly class TransactionConfig {
    use ConfigHelper;
    public function __construct(
        public string $create_area,
        public string $add_area_name,
        public string $set_primary_area_name,
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            create_area: self::requiredString($raw, 'CreateArea'),
            add_area_name: self::requiredString($raw, 'AddAreaName'),
            set_primary_area_name: self::requiredString($raw, 'SetPrimaryAreaName')

        );
    }
} 