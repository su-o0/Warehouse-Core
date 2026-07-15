<?php

namespace WarehouseCore\Contract;

use RuntimeException;
use Throwable;

abstract class Exception extends RuntimeException
{
    public function __construct(
        public readonly string $errorCode,
        string $message,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            $message, 
            $code, 
            $previous
        );
    }
}
