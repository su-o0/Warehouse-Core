<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\AreaStatusEnum;

final class AreaStatusMapper implements Mapper {
    public static function match(
        string $field
    ): AreaStatusEnum {
        return match($field){
            'Created'       => AreaStatusEnum::Created,
            'Active'        => AreaStatusEnum::Active,
            'Crowded'       => AreaStatusEnum::Crowded,
            'Archived'      => AreaStatusEnum::Archived,
            default         => throw DomainException::AREA_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): AreaStatusEnum {
        return self::match($raw[$field]);
    }
}