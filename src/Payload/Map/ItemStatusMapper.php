<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ItemStatus;

final class ItemStatusMapper {
    public static function fromRaw(
        array $raw, 
        string $field
    ): ItemStatus {
        return match($raw[$field]){
            'Created'   => ItemStatus::Created,
            'Tagged'    => ItemStatus::Tagged,
            'Prepared'  => ItemStatus::Prepared,
            'Active'    => ItemStatus::Active,
            'Sold'      => ItemStatus::Sold,
            'Archived'  => ItemStatus::Archived,
            'Lost'      => ItemStatus::Lost,
            default     => throw DomainException::ITEM_INVALID_STATUS()
        };
    }
}