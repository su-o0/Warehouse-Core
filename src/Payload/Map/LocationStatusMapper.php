<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\LocationStatus;

final class LocationStatusMapper implements Mapper{
    public static function match(
        string $field
    ): LocationStatus {
        return match($field){
            'Created'   => LocationStatus::Created,
            'Active'    => LocationStatus::Active,
            'Archived'  => LocationStatus::Archived,
            default     => throw DomainException::LOCATION_INVALID_STATUS()
        };
    }
}