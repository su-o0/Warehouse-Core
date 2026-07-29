<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ItemStatus;

final class ItemStatusMapper implements Mapper {
    public static function match(
        string $field
    ): ItemStatus {
        return match($field){
            'Created'       => ItemStatus::Created,
            'Processing'    => ItemStatus::Processing,
            'Active'        => ItemStatus::Active,
            'Sold'          => ItemStatus::Sold,
            'Archived'      => ItemStatus::Archived,
            'Lost'          => ItemStatus::Lost,
            default         => throw DomainException::ITEM_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): ItemStatus {
        return self::match($raw[$field]);
    }
}