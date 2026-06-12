<?php

namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\DomainException;

final class ItemException extends DomainException
{
    public static function ITEM_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::ITEM_ALREADY_EXISTS,
            'Item already exists'
        );
    }

    public static function ITEM_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::ITEM_NOT_FOUND,
            'Item not found'
        );
    }

    public static function ITEM_INVALID_STATUS(): self
    {
        return new self(
            ErrorCode::ITEM_INVALID_STATUS,
            'Item status must be Active|Sold|Archived|Lost'
        );
    }

    public static function ITEM_INVALID_CONDITION(): self
    {
        return new self(
            ErrorCode::ITEM_INVALID_CONDITION,
            'Item condition must be New|Good|Fair|Poor'
        );
    }

    public static function ITEM_PHYSICAL_TAG_ALREADY_USED(): self
    {
        return new self(
            ErrorCode::ITEM_PHYSICAL_TAG_ALREADY_USED,
            'Physical tag is already assigned to another active item'
        );
    }
}
