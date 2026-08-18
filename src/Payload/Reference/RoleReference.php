<?php
namespace WarehouseCore\Payload\Reference;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\RoleNameEnum;
use WarehouseCore\Payload\Map\RoleNameMapper;

final readonly class RoleReference {
    use ConfigHelper;
    public function __construct(
        public RoleNameEnum $name
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            name: RoleNameMapper::match(
                self::requiredString($raw, 'name')
            )
        );
    }
}