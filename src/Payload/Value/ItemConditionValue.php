<?php

namespace WarehouseCore\Payload\Value;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ItemCondition;

final class ItemConditionValue {

    public static function fromRaw(
        array $raw, 
        string $field
    ): null|ItemCondition {
        $value = $raw[$field] ?? null;

        if ($value === null) {
            return null;
        }
        
        return match ($raw[$field]) {
            'New'       => ItemCondition::New,
            'Good'      => ItemCondition::Good,
            'Fair'      => ItemCondition::Fair,
            'Poor'      => ItemCondition::Poor,
            default     => DomainException::ITEM_INVALID_CONDITION()
        };
    }
}
