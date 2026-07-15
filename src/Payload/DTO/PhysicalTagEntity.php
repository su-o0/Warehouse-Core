<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Type\PhysicalTagStatus;
use WarehouseCore\Payload\Map\PhysicalTagStatusMapper;

final class PhysicalTagEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly PhysicalTagStatus $status,
        public readonly string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            status: PhysicalTagStatusMapper::fromRaw(
                raw: $raw,
                field: 'status'
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}