<?php 
namespace SuO0\StorageApi\Exception;

class StorageException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function ADDRESS_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::ADDRESS_ALREADY_EXISTS,
            'Address already exists'
        );
    }
}