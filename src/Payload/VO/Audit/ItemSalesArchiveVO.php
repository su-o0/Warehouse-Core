<?php 
namespace WarehouseCore\Payload\VO\Audit;

use WarehouseCore\Config\ConfigHelper;

final readonly class ItemSalesArhiveVO {
    use ConfigHelper;
    public function __construct(
        public int $item_id,
        public int $user_id,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            item_id: self::requiredInt($raw, 'item_id'),
            user_id: self::requiredInt($raw, 'user_id'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredInt($raw, 'created_at')
        );
    } 
}