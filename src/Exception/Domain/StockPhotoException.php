<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class StockPhotoException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function STOCK_PHOTO_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::STOCK_PHOTO_ALREADY_EXISTS,
            'Stock photo already exists'
        );
    }

    public static function STOCK_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::STOCK_PHOTO_NOT_FOUND,
            'Stock photo not found'
        );
    }
}