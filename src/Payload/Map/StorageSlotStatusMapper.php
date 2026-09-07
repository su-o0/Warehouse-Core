<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\StorageSlotStatusEnum;

final class StorageSlotStatusMapper implements Mapper{
    public static function match(
        string $field
    ): StorageSlotStatusEnum {
        return match($field){
            'Registered'   => StorageSlotStatusEnum::Registered,
            'Active'    => StorageSlotStatusEnum::Active,
            'Crowded'   => StorageSlotStatusEnum::Crowded,
            'Archived'  => StorageSlotStatusEnum::Archived,
            default     => throw DomainException::STORAGE_SLOT_STATUS_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw, 
        string $field
    ): StorageSlotStatusEnum {
        return self::match($raw[$field]);
    }
}