<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

final class StockEntity {
    use ConfigHelper;
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $container_id,
        public readonly ?int $part_id,
        public readonly ?int $qty,
        public readonly ?string $created_at
    )
    { }

    public static function fromRaw(array $raw): self {
        return new self(
            self::requiredInt($raw, 'id'),
            self::requiredInt($raw, 'container_id'),
            self::requiredInt($raw, 'part_id'),
            self::requiredInt($raw, 'qty'),
            self::requiredString($raw, 'created_at')
        );
    } 
}