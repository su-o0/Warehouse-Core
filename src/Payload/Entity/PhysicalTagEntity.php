<?php 
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\PhysicalTagStatusEnum;
use WarehouseCore\Payload\Map\PhysicalTagStatusMapper;

final readonly class PhysicalTagEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public PhysicalTagStatusEnum $status,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            status: PhysicalTagStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}