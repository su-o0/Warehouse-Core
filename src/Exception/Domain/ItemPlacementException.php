<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class ItemPlacementException extends DomainException
{
    public static function ITEM_PLACEMENT_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::ITEM_PLACEMENT_ALREADY_EXISTS,
            'Item placement already exists'
        );
    }

    public static function ITEM_PLACEMENT_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::ITEM_PLACEMENT_NOT_FOUND,
            'Item placement not found'
        );
    }
}
