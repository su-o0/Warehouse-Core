<?php
namespace WarehouseCore\Exception;

use RuntimeException;

abstract class DomainException extends RuntimeException {
    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }
}