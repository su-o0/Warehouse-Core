<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\RoleName;

final class RoleNameMapper {
    public static function fromRaw(
        array $raw, 
        string $field
    ): RoleName {
        return match($raw[$field]){
            'Root' => RoleName::Root,
            'Admin' => RoleName::Admin,
            'Worker' => RoleName::Worker,
            'Salesman' => RoleName::Salesman,
            'Viewer' => RoleName::Viewer,
            default => throw DomainException::ROLE_NAME_INVALID()
        };
    }
}