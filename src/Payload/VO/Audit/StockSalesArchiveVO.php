<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Config\ConfigHelper;

final readonly class StockSalesArhiveValue {
    use ConfigHelper;
    public function __construct(
        public int $stock_id,
        public int $qty,
        public int $user_id,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            stock_id: self::requiredInt($raw, 'stock_id'),
            qty: self::requiredInt($raw, 'qty'),
            user_id: self::requiredInt($raw, 'user_id'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredInt($raw, 'created_at')
        );
    } 
}