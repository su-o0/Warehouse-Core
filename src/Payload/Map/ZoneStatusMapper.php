<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ZoneStatusEnum;

final class ZoneStatusMapper implements Mapper {
    public static function match(
        string $field
    ): ZoneStatusEnum {
        return match($field){
            'Created'       => ZoneStatusEnum::Created,
            'Active'        => ZoneStatusEnum::Active,
            'Crowded'       => ZoneStatusEnum::Crowded,
            'Archived'      => ZoneStatusEnum::Archived,
            default         => throw DomainException::ZONE_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): ZoneStatusEnum {
        return self::match($raw[$field]);
    }
}