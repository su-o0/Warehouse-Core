<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class ContainerPlacementException extends DomainException
{
    public static function CONTAINER_PLACEMENT_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_ALREADY_EXISTS,
            'Container placement already exists'
        );
    }

    public static function CONTAINER_PLACEMENT_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_NOT_FOUND,
            'Container placement not found'
        );
    }
}
