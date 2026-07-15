<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ContainerTypeMapper;
use WarehouseCore\Payload\Type\ContainerType;

final class ContainerEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly ContainerType $type,
        public readonly int $created_by_user_id,
        public readonly string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            type: ContainerTypeMapper::fromRaw(
                raw: $raw, 
                field: 'type'
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}