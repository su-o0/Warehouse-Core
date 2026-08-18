<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;

final readonly class VehicleEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public string $vin,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            vin: self::requiredString($raw, 'vin'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    } 
}