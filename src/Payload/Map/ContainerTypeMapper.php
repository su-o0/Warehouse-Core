<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ContainerType;

final class ContainerTypeMapper {
    public static function fromString(
        string $raw,
    ): ContainerType {
        return match ($raw) {
            'Box' => ContainerType::Box,
            'Pallet' => ContainerType::Pallet,
            default => throw DomainException::CONTAINER_INVALID_TYPE()
        };
    }
    public static function fromRaw(
        array $raw,
        string $field
    ): ContainerType {
        return match ($raw[$field]) {
            'Box' => ContainerType::Box,
            'Pallet' => ContainerType::Pallet,
            default => throw DomainException::CONTAINER_INVALID_TYPE()
        };
    }
}
