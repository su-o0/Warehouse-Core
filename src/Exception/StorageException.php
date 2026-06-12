<?php 
namespace WarehouseCore\Exception;

class StorageException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function SERVICE_NOT_FOUND(string $name): self {
        return new self(
            ErrorCode::SERVICE_NOT_FOUND,
            "Service $name not found"
        );
    }

    public static function DB_CONNECTION_ERROR(): self {
        return new self(
            ErrorCode::DB_CONNECTION_ERROR,
            'Database connection error occurred'
        );
    }

    public static function DB_QUERY_ERROR(): self {
        return new self(
            ErrorCode::DB_DUPLICATE_ERROR,
            'Database duplicate entry error occurred'
        );
    }

    public static function DB_RELATION_ERROR(): self {
        return new self(
            ErrorCode::DB_RELATION_ERROR,
            'Database relation error occurred'
        );
    }

    public static function DB_DUPLICATE_ERROR(): self {
        return new self(
            ErrorCode::DB_DUPLICATE_ERROR,
            'Database duplicate entry error occurred'
        );
    }

    public static function DB_UNKNOWN_ERROR(): self {
        return new self(
            ErrorCode::DB_UNKNOWN_ERROR,
            'Unknown database error occurred'
        );
    }

    public static function SALES_ARCHIVE_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::SALES_ARCHIVE_PHOTO_NOT_FOUND,
            'Sales archive photo not found'
        );
    }

    public static function HISTORY_NOT_FOUND(): self {
        return new self(
            ErrorCode::HISTORY_NOT_FOUND,
            'History not found'
        );
    }

    public static function PERMISSION_DENIED(): self {
        return new self(
            ErrorCode::PERMISSION_DENIED,
            'Permission denied'
        );
    }
}