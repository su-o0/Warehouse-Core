<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\RoleNameEnum;

final class RoleNameMapper implements Mapper {
    public static function match(
        string $field
    ): RoleNameEnum {
        return match($field){
            'Root'      => RoleNameEnum::Root,
            'Admin'     => RoleNameEnum::Admin,
            'Worker'    => RoleNameEnum::Worker,
            'Salesman'  => RoleNameEnum::Salesman,
            'Viewer'    => RoleNameEnum::Viewer,
            default     => throw DomainException::ROLE_NAME_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): RoleNameEnum {
        return self::match($raw[$field]);
    }

    public static function fromString(
        string $field
    ): RoleNameEnum {
        return self::match($field);
    }
}