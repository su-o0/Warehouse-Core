<?php 
namespace WarehouseCore\Exception\Domain;

use WarehouseCore\Exception\ErrorCode;

class PtysicalTagException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function PHYSICAL_TAG_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_ALREADY_EXISTS,
            'Physical tag already exists'
        );
    }

    public static function PHYSICAL_TAG_NOT_FOUND(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_NOT_FOUND,
            'Physical tag not found'
        );
    }

    public static function PHYSICAL_TAG_INVALID_STATUS(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_INVALID_STATUS,
            'PhysicalTag Status must be Free, Assigned, Lost or Broken'
        );
    }
}