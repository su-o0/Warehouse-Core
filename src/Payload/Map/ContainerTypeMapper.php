<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ContainerType;

final class ContainerTypeMapper implements Mapper{
    public static function match(
        string $field
    ): ContainerType {
        return match ($field) {
            'Box' => ContainerType::Box,
            'Pallet' => ContainerType::Pallet,
            default => throw DomainException::CONTAINER_TYPE_INVALID_TYPE()
        };
    }
}
