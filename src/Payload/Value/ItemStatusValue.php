<?php
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ItemStatus;

final class ItemStatusValue {

    public static function fromRaw(
        array $raw, 
        string $field
    ): null|ItemStatus {
        $value = $raw[$field] ?? null;

        if ($value === null) {
            return null;
        }

        return match($raw[$field]){
            'Active'    => ItemStatus::Active,
            'Sold'      => ItemStatus::Sold,
            'Archived'  => ItemStatus::Archived,
            'Lost'      => ItemStatus::Lost,
            default     => throw DomainException::ITEM_INVALID_STATUS()
        };
    }
}