<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class PartException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function PART_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::PART_ALREADY_EXISTS,
            'Part already exists'
        );
    }

    public static function PART_NOT_FOUND(): self {
        return new self(
            ErrorCode::PART_NOT_FOUND,
            'Part not found'
        );
    }
}