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
}
