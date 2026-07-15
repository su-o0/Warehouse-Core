<?php
namespace WarehouseCore\Validation;

use WarehouseCore\Contract\Validator;
use WarehouseCore\Exception\ValidationException;
use WarehouseCore\Payload\Request\CreateUserRequest;

final class CreateUserValidator implements Validator{
    public static function validate(
        array $arguments
    ): CreateUserRequest {
        if (!isset($arguments['name'])) {
            throw ValidationException::FIELD_MISSING('name');
        }

        if (!isset($arguments['role'])) {
            throw ValidationException::FIELD_MISSING('role');
        }

        if (!is_string($arguments['name'])) {
            throw ValidationException::INVALID_TYPE('name', 'string');
        }

        if (!is_string($arguments['role'])) {
            throw ValidationException::INVALID_TYPE('role', 'string');
        }
        $name = $arguments['name'];
        $role = $arguments['role'];

        return new CreateUserRequest(
            $name,
            $role
        );
    }
}