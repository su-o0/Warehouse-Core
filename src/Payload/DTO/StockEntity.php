<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Type\StockStatus;
use WarehouseCore\Payload\Value\StockStatusValue;

final class StockEntity {
    use ConfigHelper;
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $part_id,
        public readonly ?int $qty,
        public readonly StockStatus $status,
        public readonly ?string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            part_id: self::requiredInt($raw, 'part_id'),
            qty: self::requiredInt($raw, 'qty'),
            status: StockStatusValue::fromRaw($raw, 'status'),
            created_at: self::requiredString($raw, 'created_at')
        );
    } 
}