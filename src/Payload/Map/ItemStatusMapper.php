<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ItemStatusEnum;

final class ItemStatusMapper implements Mapper {
    public static function match(
        string $field
    ): ItemStatusEnum {
        return match($field){
            'Created'       => ItemStatusEnum::Created,
            'Processing'    => ItemStatusEnum::Processing,
            'Active'        => ItemStatusEnum::Active,
            'Sold'          => ItemStatusEnum::Sold,
            'Archived'      => ItemStatusEnum::Archived,
            'Lost'          => ItemStatusEnum::Lost,
            default         => throw DomainException::ITEM_STATUS_INVALID_TYPE()
        };
    }

    public static function fromRaw(
        array $raw, 
        string $field
    ): ItemStatusEnum {
        return self::match($raw[$field]);
    }
}