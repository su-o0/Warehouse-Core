<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

final class LocationEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly AddressValue $address,
        public readonly string $created_at,
    ) {}

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            address: AddressValue::fromRaw($raw),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}