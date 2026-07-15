<?php 
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Config\ConfigHelper;

final class StockSalesArhiveValue {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly int $stock_id,
        public readonly int $qty,
        public readonly int $user_id,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            stock_id: self::requiredInt($raw, 'stock_id'),
            qty: self::requiredInt($raw, 'qty'),
            user_id: self::requiredInt($raw, 'user_id'),
            created_at: self::requiredInt($raw, 'created_at')
        );
    } 
}