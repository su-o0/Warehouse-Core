<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class LocationException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function LOCATION_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::LOCATION_ALREADY_EXISTS,
            'Location with the same address already exists'
        );
    }

    public static function LOCATION_NOT_FOUND(): self {
        return new self(
            ErrorCode::LOCATION_NOT_FOUND,
            'Location not found'
        );
    }
}