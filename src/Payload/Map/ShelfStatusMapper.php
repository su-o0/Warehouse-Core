<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ShelfStatusEnum;

final class ShelfStatusMapper implements Mapper{
    public static function match(
        string $field
    ): ShelfStatusEnum {
        return match($field){
            'Created'   => ShelfStatusEnum::Created,
            'Active'    => ShelfStatusEnum::Active,
            'Crowded'   => ShelfStatusEnum::Crowded,
            'Archived'  => ShelfStatusEnum::Archived,
            default     => throw DomainException::STOCK_STATUS_INVALID_TYPE()
        };
    }
    public static function fromRaw(
        array $raw, 
        string $field
    ): ShelfStatusEnum {
        return self::match($raw[$field]);
    }
}