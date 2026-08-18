<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\StockStatusEnum;

final class StockStatusMapper implements Mapper{
    public static function match(
        string $field
    ): StockStatusEnum {
        return match($field){
            'Created'   => StockStatusEnum::Created,
            'Placed'    => StockStatusEnum::Placed,
            'Active'    => StockStatusEnum::Active,
            'Adjusted'  => StockStatusEnum::Adjusted,
            'Crowded'   => StockStatusEnum::Crowded,
            'Archived'  => StockStatusEnum::Archived,
            default     => throw DomainException::STOCK_STATUS_INVALID_TYPE()
        };
    }
    public static function fromRaw(
        array $raw, 
        string $field
    ): StockStatusEnum {
        return self::match($raw[$field]);
    }
}