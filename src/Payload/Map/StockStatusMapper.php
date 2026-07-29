<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\StockStatus;

final class StockStatusMapper implements Mapper{
    public static function match(
        string $field
    ): StockStatus {
        return match($field){
            'Created'   => StockStatus::Created,
            'Placed'    => StockStatus::Placed,
            'Active'    => StockStatus::Active,
            'Adjusted'  => StockStatus::Adjusted,
            'Crowded'   => StockStatus::Crowded,
            'Archived'  => StockStatus::Archived,
            default     => throw DomainException::STOCK_STATUS_INVALID_TYPE()
        };
    }
    public static function fromRaw(
        array $raw, 
        string $field
    ): StockStatus {
        return self::match($raw[$field]);
    }
}