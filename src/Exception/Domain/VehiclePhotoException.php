<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class VehiclePhotoException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }
    
    public static function VEHICLE_PHOTO_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::VEHICLE_PHOTO_ALREADY_EXISTS,
            'Car photo already exists'
        );
    }

    public static function VEHICLE_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::VEHICLE_PHOTO_NOT_FOUND,
            'Car photo not found'
        );
    }
}