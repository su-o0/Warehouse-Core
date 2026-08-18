<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\OwnerStatusEnum;

final class OwnerStatusMapper implements Mapper {
    public static function match(
        string $field
    ): OwnerStatusEnum {
        return match($field){
            'Active'        => OwnerStatusEnum::Active,
            'Archived'      => OwnerStatusEnum::Archived,
            default         => throw DomainException::OWNER_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): OwnerStatusEnum {
        return self::match($raw[$field]);
    }
}