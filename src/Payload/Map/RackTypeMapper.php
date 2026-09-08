<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\RackTypeEnum;

final class RackTypeMapper implements Mapper {
    public static function match(
        string $field
    ): RackTypeEnum {
        return match($field){
            'Shelf'         => RackTypeEnum::Shelf,
            'StorageSlot'    => RackTypeEnum::StorageSlot,
            default         => throw DomainException::RACK_TYPE_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): RackTypeEnum {
        return self::match($raw[$field]);
    }
}