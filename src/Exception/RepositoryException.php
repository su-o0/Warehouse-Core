<?php

namespace WarehouseCore\Exception;

use RuntimeException;
use Throwable;

final class RepositoryException extends RuntimeException {
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

    public static function DB_CONNECTION_ERROR(?Throwable $previous = null): self
    {
        return new self(
            ErrorCode::DB_CONNECTION_ERROR,
            'Database connection error',
        );
    }

    public static function DB_QUERY_ERROR(?Throwable $previous = null): self
    {
        return new self(
            ErrorCode::DB_QUERY_ERROR,
            'Database query error',
            0,
            $previous
        );
    }

    public static function DB_RELATION_ERROR(?Throwable $previous = null): self
    {
        return new self(
            ErrorCode::DB_RELATION_ERROR,
            'Foreign key constraint violation',
            0,
            $previous
        );
    }

    public static function DB_DUPLICATE_ERROR(?Throwable $previous = null): self
    {
        return new self(
            ErrorCode::DB_DUPLICATE_ERROR,
            'Duplicate entry',
            0,
            $previous
        );
    }

    public static function DB_UNKNOWN_ERROR(?Throwable $previous = null): self
    {
        return new self(
            ErrorCode::DB_UNKNOWN_ERROR,
            'Unknown database error',
            0,
            $previous
        );
    }
}
