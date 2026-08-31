<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\UserStatusEnum;

final class UserStatusMapper implements Mapper {
    public static function match(
        string $field
    ): UserStatusEnum {
        return match($field){
            'Created'       => UserStatusEnum::Created,
            'Processing'    => UserStatusEnum::Processing,
            'Active'        => UserStatusEnum::Active,
            'Archived'      => UserStatusEnum::Archived,
            default         => throw DomainException::USER_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): UserStatusEnum {
        return self::match($raw[$field]);
    }
}