<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class ContainerException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function CONTAINER_INVALID_TYPE(): self {
        return new self(
            ErrorCode::CONTAINER_INVALID_TYPE,
            'Container type must be Box or Pallet'
        );
    }

    public static function CONTAINER_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::CONTAINER_ALREADY_EXISTS,
            'Container already exists'
        );
    }

    public static function CONTAINER_NOT_FOUND(): self {
        return new self(
            ErrorCode::CONTAINER_NOT_FOUND,
            'Container not found'
        );
    }
}