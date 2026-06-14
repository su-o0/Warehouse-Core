<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

final class VehicleEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly string $vin,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            self::requiredInt($raw, 'id'),
            self::requiredString($raw, 'vin'),
            self::requiredString($raw, 'created_at'),
        );
    } 
}