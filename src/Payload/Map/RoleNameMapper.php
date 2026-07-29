<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\RoleName;

final class RoleNameMapper implements Mapper {
    public static function match(
        string $field
    ): RoleName {
        return match($field){
            'Root' => RoleName::Root,
            'Admin' => RoleName::Admin,
            'Worker' => RoleName::Worker,
            'Salesman' => RoleName::Salesman,
            'Viewer' => RoleName::Viewer,
            default => throw DomainException::ROLE_NAME_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): RoleName {
        return self::match($raw[$field]);
    }

    public static function fromString(
        string $field
    ): RoleName {
        return self::match($field);
    }
}