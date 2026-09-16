<?php
namespace WarehouseCore\Exception;

use Error;
use WarehouseCore\Contract\Exception as ExceptionContract;

final class ValidationException extends ExceptionContract {
    
    public static function FIELD_MISSING(
        string $field
    ): self {
        return new self(
            ErrorCode::VALIDATION_FIELD_MISSING,
            "Field '{$field}' is required"
        );
    }

    public static function INVALID_TYPE(
        string $field, 
        string $expected
    ): self {
        return new self(
            ErrorCode::VALIDATION_INVALID_TYPE,
            "Field '{$field}' must be {$expected}"
        );
    }

    public static function EXACTLY_ONE_REQUIRED(
        string $code,
        array $fields
    ): self {
        $list = implode(', ', $fields);
        return new self(
            $code,
            "Exactly one of [{$list}] must be provided"
        );
    }

    public static function BAG_TYPE_MISMATCH(
        string $field
    ): self {
        return new self(
            ErrorCode::BAG_TYPE_MISMATCH,
            "Field '{$field}' cannot be null"
        );
    }

    public static function BAG_SCHEMA_ERROR(): self {
        return new self(
            ErrorCode::BAG_TYPE_MISMATCH,
            "Not specified 'type' in schema"
        );
    }

    public static function BAG_MISSING_PARAMETER(
        string $field
    ): self {
        return new self(
            ErrorCode::BAG_MISSING_PARAMETER,
            "Field: '{$field}' is absent"
        );  
    }

    public static function BAG_NOT_FOUND_PARAMETER(
        string $field
    ): self {
        return new self(
            ErrorCode::BAG_NOT_FOUND_PARAMETER,
            "Field: '{$field}' not found"
        ); 
    }

    public static function BAG_UNKNOWN_TYPE(
        string $field,
        string $type
    ): self {
        return new self(
            ErrorCode::BAG_UNKNOWN_TYPE,
            "Unknown type '{$type}' for '{$field}'"
        );
    }

    public static function BAG_TYPE_WAIT_MISMATCH(
        string $field,
        string $type,
        string $actual
    ): self {
        return new self(
            ErrorCode::BAG_TYPE_WAIT_MISMATCH,
            "Field: '{$field}' wait '{$type}', get '{$actual}'"
        );
    }
}