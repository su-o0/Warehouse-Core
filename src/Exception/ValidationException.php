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
}