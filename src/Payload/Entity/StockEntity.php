<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\StockStatusMapper;
use WarehouseCore\Payload\Enum\StockStatusEnum;

final readonly class StockEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public ?int $part_id,
        public int $qty,
        public StockStatusEnum $status,
        public int $created_by_user_id,
        public ?string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            part_id: self::nullableInt($raw, 'part_id'),
            qty: self::requiredInt($raw, 'qty'),
            status: StockStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    } 
}   