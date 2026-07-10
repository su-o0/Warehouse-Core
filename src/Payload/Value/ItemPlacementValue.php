<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Config\ConfigHelper;

final class ItemPlacementValue {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly int $location_id,
        public readonly int $container_id,
        public readonly int $item_id,
        public readonly int $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            location_id: self::requiredInt($raw, 'location_id'),
            container_id: self::requiredInt($raw, 'container_id'),
            item_id: self::requiredInt($raw, 'item_id'),
            created_at: self::requiredInt($raw, 'created_at')
        );
    }
}