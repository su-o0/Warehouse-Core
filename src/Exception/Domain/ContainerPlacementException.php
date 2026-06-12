<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class ContainerPlacementException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function CONTAINER_PLACEMENT_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_ALREADY_EXISTS,
            'Container placement already exists'
        );
    }

    public static function CONTAINER_PLACEMENT_NOT_FOUND(): self {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_NOT_FOUND,
            'Container placement not found'
        );
    }
}