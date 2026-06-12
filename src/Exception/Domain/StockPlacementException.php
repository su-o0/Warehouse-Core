<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class StockPlacementException extends DomainException
{
    public static function STOCK_PLACEMENT_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::STOCK_PLACEMENT_ALREADY_EXISTS,
            'Stock placement already exists'
        );
    }

    public static function STOCK_PLACEMENT_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::STOCK_PLACEMENT_NOT_FOUND,
            'Stock placement not found'
        );
    }

    public static function STOCK_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::STOCK_ALREADY_EXISTS,
            'Stock already exists'
        );
    }

    public static function STOCK_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::STOCK_NOT_FOUND,
            'Stock not found'
        );
    }
}
