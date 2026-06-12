<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class ItemPhotoException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }
    
    public static function ITEM_PHOTO_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::ITEM_PHOTO_ALREADY_EXISTS,
            'Item photo already exists'
        );
    }

    public static function ITEM_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_PHOTO_NOT_FOUND,
            'Item photo not found'
        );
    }
}