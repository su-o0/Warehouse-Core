<?php
namespace WarehouseCore\Exception;

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
}