<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class VehicleException extends DomainException
{
    public static function VEHICLE_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::VEHICLE_ALREADY_EXISTS,
            'Car already exists'
        );
    }

    public static function VEHICLE_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::VEHICLE_NOT_FOUND,
            'Car not found'
        );
    }
}
