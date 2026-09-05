<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\RackStatusEnum;

final class RackStatusMapper implements Mapper {
    public static function match(
        string $field
    ): RackStatusEnum {
        return match($field){
            'Registered'   => RackStatusEnum::Registered,
            'Active'    => RackStatusEnum::Active,
            'Crowded'   => RackStatusEnum::Crowded,
            'Archived'  => RackStatusEnum::Archived,
            default     => throw DomainException::RACK_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): RackStatusEnum {
        return self::match($raw[$field]);
    }
}