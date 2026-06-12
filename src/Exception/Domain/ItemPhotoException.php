<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class ItemPhotoException extends DomainException
{
    public static function ITEM_PHOTO_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::ITEM_PHOTO_ALREADY_EXISTS,
            'Item photo already exists'
        );
    }

    public static function ITEM_PHOTO_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::ITEM_PHOTO_NOT_FOUND,
            'Item photo not found'
        );
    }
}
