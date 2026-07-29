<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\PlacementEntity;

final class PlacementEntityMapper implements Mapper {
    public static function match(
        string $field
    ): PlacementEntity {
        return match($field){
            'Container' => PlacementEntity::Container,
            'Item'  => PlacementEntity::Item,
            'Stock' => PlacementEntity::Stock,
            default => throw DomainException::PLACEMENT_ENTITY_INVALID_TYPE()
        };
    } 

    public static function fromString(
        string $field
    ): PlacementEntity {
        return self::match($field);
    }
}