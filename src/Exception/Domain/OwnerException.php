<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class OwnerException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function OWNER_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::OWNER_ALREADY_EXISTS,
            'Owner already exists'
        );
    }

    public static function OWNER_NOT_FOUND(): self {
        return new self(
            ErrorCode::OWNER_NOT_FOUND,
            'Owner not found'
        );
    }

    public static function OWNER_INVALID_PERMISSION(): self {
        return new self(
            ErrorCode::OWNER_INVALID_PERMISSION,
            'Permission must be Admin|Worker|Salesman'
        );
    }

    public static function OWNER_USERID_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::OWNER_USERID_ALREADY_EXISTS,
            'Owner with the same UserId already exists'
        );
    }
    
    public static function OWNER_NAME_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::OWNER_NAME_ALREADY_EXISTS,
            'Owner with the same Name already exists'
        );
    }
}