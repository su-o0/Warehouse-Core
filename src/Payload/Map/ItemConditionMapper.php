<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ItemCondition;

final class ItemConditionMapper {
    public static function fromRaw(
        array $raw, 
        string $field
    ): ItemCondition {
        return match ($raw[$field]) {
            'New'       => ItemCondition::New,
            'Good'      => ItemCondition::Good,
            'Fair'      => ItemCondition::Fair,
            'Poor'      => ItemCondition::Poor,
            default     => throw DomainException::ITEM_INVALID_CONDITION()
        };
    }
}
