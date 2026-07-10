<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Config\ConfigHelper;

final class StockPlacementValue {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly int $location_id,
        public readonly int $container_id,
        public readonly int $stock_id,
        public readonly int $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            location_id: self::requiredInt($raw, 'location_id'),
            container_id: self::requiredInt($raw, 'container_id'),
            stock_id: self::requiredInt($raw, 'stock_id'),
            created_at: self::requiredInt($raw, 'created_at')
        );
    }
}