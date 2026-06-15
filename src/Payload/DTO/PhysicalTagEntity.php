<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Type\PhysicalTagStatus;
use WarehouseCore\Payload\DTO\PhysicalTagStatusValue;

final class PhysicalTagEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly PhysicalTagStatus $status,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            self::requiredInt($raw, 'id'),
            PhysicalTagStatusValue::fromRaw(
                self::requiredString($raw, 'status')
            ),
            self::requiredString($raw, 'created_at')
        );
    }
}