<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ItemCondition;

final class ItemConditionMapper implements Mapper {
    public static function match(
        string $field
    ): ItemCondition {
        return match ($field) {
            'New'       => ItemCondition::New,
            'Good'      => ItemCondition::Good,
            'Fair'      => ItemCondition::Fair,
            'Poor'      => ItemCondition::Poor,
            default     => throw DomainException::ITEM_CONDITION_INVALID_TYPE()
        };
    }
}
