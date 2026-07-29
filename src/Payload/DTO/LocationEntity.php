<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Type\LocationStatus;
use WarehouseCore\Payload\Value\AddressValue;
use WarehouseCore\Payload\Map\LocationStatusMapper;

final readonly class LocationEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public AddressValue $address,
        public LocationStatus $status,
        public int $created_by_user_id,
        public string $created_at,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            address: AddressValue::fromRaw($raw),
            status: LocationStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}