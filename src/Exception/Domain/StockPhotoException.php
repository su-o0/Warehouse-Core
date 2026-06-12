<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class StockPhotoException extends DomainException
{
    public static function STOCK_PHOTO_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::STOCK_PHOTO_ALREADY_EXISTS,
            'Stock photo already exists'
        );
    }

    public static function STOCK_PHOTO_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::STOCK_PHOTO_NOT_FOUND,
            'Stock photo not found'
        );
    }
}
