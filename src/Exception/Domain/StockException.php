<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class StockException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function STOCK_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::STOCK_ALREADY_EXISTS,
            'Stock already exists'
        );
    }

    public static function STOCK_NOT_FOUND(): self {
        return new self(
            ErrorCode::STOCK_NOT_FOUND,
            'Stock not found'
        );
    }
}