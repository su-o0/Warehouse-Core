<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

final class PhotoEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly string $file,
        public readonly ?int $item_id = null,
        public readonly ?int $stock_id = null,
        public readonly ?int $vehicle_id = null,
        public readonly int $created_by_user_id,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            file: self::requiredString($raw, 'file'),
            item_id: self::nullableInt($raw, 'item_id'),
            stock_id: self::nullableInt($raw, 'stock_id'),
            vehicle_id: self::nullableInt($raw, 'vehicle_id'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }
}