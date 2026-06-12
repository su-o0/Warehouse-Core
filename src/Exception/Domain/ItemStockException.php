<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class ItemException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function ITEM_PLACEMENT_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::ITEM_PLACEMENT_ALREADY_EXISTS,
            'Item placement already exists'
        );
    }

    public static function ITEM_PLACEMENT_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_PLACEMENT_NOT_FOUND,
            'Item placement not found'
        );
    }

    public static function ITEM_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::ITEM_ALREADY_EXISTS,
            'Item already exists'
        );
    }

    public static function ITEM_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_NOT_FOUND,
            'Item not found'
        );
    }

    public static function ITEM_INVALID_STATUS(): self {
        return new self(
            ErrorCode::ITEM_INVALID_STATUS,
            'Item status must be Active|Sold|Archived|Lost'
        );
    }

    public static function ITEM_INVALID_CONDITION(): self {
        return new self(
            ErrorCode::ITEM_INVALID_CONDITION,
            'Item condition must be New|Good|Fair|Poor'
        );
    }

    public static function ITEM_PHYSICAL_TAG_ALREADY_USED(): self {
        return new self(
            ErrorCode::ITEM_PHYSICAL_TAG_ALREADY_USED,
            'Physical tag is already assigned to another active item'
        );
    }
}