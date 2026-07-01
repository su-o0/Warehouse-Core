<?php
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\StockStatus;

final class StockStatusValue {

    public static function fromRaw(
        array $raw, 
        string $field
    ): StockStatus {
        return match($raw[$field]){
            'Created'   => StockStatus::Created,
            'Placed'    => StockStatus::Placed,
            'Active'    => StockStatus::Active,
            'Adjusted'  => StockStatus::Adjusted,
            'Crowded'   => StockStatus::Crowded,
            'Archived'  => StockStatus::Archived,
            default     => throw DomainException::STOCK_INVALID_STATUS()
        };
    }
}