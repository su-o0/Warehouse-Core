<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ItemConditionEnum;

final class ItemConditionMapper implements Mapper {
    public static function match(
        string $field
    ): ItemConditionEnum {
        return match ($field) {
            'New'       => ItemConditionEnum::New,
            'Good'      => ItemConditionEnum::Good,
            'Fair'      => ItemConditionEnum::Fair,
            'Poor'      => ItemConditionEnum::Poor,
            default     => throw DomainException::ITEM_CONDITION_INVALID_TYPE()
        };
    }
}
