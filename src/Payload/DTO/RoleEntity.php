<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Type\RoleName;
use WarehouseCore\Payload\Map\RoleNameMapper;

final class RoleEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly RoleName $name,
        public readonly string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            name: RoleNameMapper::fromRaw(
                raw: $raw, 
                field: 'name'
            ),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }
}