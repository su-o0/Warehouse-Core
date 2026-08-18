<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\PartStatusMapper;
use WarehouseCore\Payload\Enum\PartStatusEnum;

final readonly class PartEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public PartStatusEnum $status,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            status: PartStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_at: self::requiredString($raw, 'created_at'),
        );
    } 
}