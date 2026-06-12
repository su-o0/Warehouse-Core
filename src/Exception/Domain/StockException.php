<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class StockException extends DomainException
{
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
