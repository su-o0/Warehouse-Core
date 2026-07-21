<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\RoleNameMapper;
use WarehouseCore\Payload\Type\RoleName;

final readonly class CreateUserRequest {
    use ConfigHelper;
    public function __construct(
        public string $name,
        public RoleName $role
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            name: self::requiredString($raw, 'name'),
            role: RoleNameMapper::fromString(
                self::requiredString($raw, 'role')
            )
        );
    }
}