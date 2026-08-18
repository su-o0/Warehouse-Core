<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\PartStatusEnum;

final class PartStatusMapper implements Mapper {
    public static function match(
        string $field
    ): PartStatusEnum {
        return match($field){
            'Created'       => PartStatusEnum::Created,
            'Processing'    => PartStatusEnum::Processing,
            'Active'        => PartStatusEnum::Active,
            'Archived'      => PartStatusEnum::Archived,
            default         => throw DomainException::PART_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): PartStatusEnum {
        return self::match($raw[$field]);
    }
}