<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class VehicleException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }
    
    
    public static function VEHICLE_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::VEHICLE_ALREADY_EXISTS,
            'Car already exists'
        );
    }

    public static function VEHICLE_NOT_FOUND(): self {
        return new self(
            ErrorCode::VEHICLE_NOT_FOUND,
            'Car not found'
        );
    }
}