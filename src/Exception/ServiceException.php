<?php

namespace WarehouseCore\Exception;

class ServiceException extends \RuntimeException
{
    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function SERVICE_NOT_FOUND(string $name): self
    {   
        return new self(
            ErrorCode::SERVICE_NOT_FOUND,
            "Service $name not found"
        );
    }

    public static function USER_IDENTITY_NOT_FOUND(): self 
    {
        return new self(
            ErrorCode::USER_IDENTITY_NOT_FOUND,
            "User identity noy found"
        );
    }

    public static function AUTHENTICATION_FAILED(): self 
    {
        return new self(
            ErrorCode::AUTHENTICATION_FAILED,
            ErrorMessage::AUTHENTICATION_FAILED
        );
    } 

    public static function FORBIDDEN(): self {
        return new self(
            ErrorCode::FORBIDDEN,
            ErrorMessage::FORBIDDEN
        );
    }
}
