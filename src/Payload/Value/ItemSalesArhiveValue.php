<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Config\ConfigHelper;

final class ItemSalesArhiveValue {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly int $item_id,
        public readonly int $user_id,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            item_id: self::requiredInt($raw, 'item_id'),
            user_id: self::requiredInt($raw, 'user_id'),
            created_at: self::requiredInt($raw, 'created_at')
        );
    } 
}