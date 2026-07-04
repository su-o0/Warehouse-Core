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
            id: self::requiredInt($raw, 'id'),
            vin: self::requiredString($raw, 'vin'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    } 
}