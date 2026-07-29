<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\PlacementTarget;

final class PlacementTargetMapper implements Mapper{
    public static function match(
        string $field
    ): PlacementTarget {
        return match($field){
            'Location'  => PlacementTarget::Location,
            'Container' => PlacementTarget::Container,
            default => throw DomainException::PLACEMENT_TARGET_INVALID_TYPE()
        };
    } 

    public static function fromString(
        string $field
    ): PlacementTarget {
        return self::match($field);
    }
}