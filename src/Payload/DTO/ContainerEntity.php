<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\ContainerTypeValue;
use WarehouseCore\Type\ContainerType;

final class ContainerEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly ContainerType $type,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            self::requiredInt($raw, 'id'),
            ContainerTypeValue::fromRaw(
                self::requiredString($raw, 'type')
            ),
            self::requiredString($raw, 'created_at')
        );
    }
}