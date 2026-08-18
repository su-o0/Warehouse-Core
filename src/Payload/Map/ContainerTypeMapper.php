<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ContainerTypeEnum;

final class ContainerTypeMapper implements Mapper{
    public static function match(
        string $field
    ): ContainerTypeEnum {
        return match ($field) {
            'Box' => ContainerTypeEnum::Box,
            'Pallet' => ContainerTypeEnum::Pallet,
            default => throw DomainException::CONTAINER_TYPE_INVALID_TYPE()
        };
    }
}
