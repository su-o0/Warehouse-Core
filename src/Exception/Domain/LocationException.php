<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class LocationException extends DomainException
{
    public static function LOCATION_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::LOCATION_ALREADY_EXISTS,
            'Location with the same address already exists'
        );
    }

    public static function LOCATION_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::LOCATION_NOT_FOUND,
            'Location not found'
        );
    }
}
