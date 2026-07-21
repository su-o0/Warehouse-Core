<?php
namespace WarehouseCore\Exception;

final class ErrorMessage {
    public const SERVICE_UNAVAILABLE = 'Service temporarily unavailable';
    public const FORBIDDEN = 'Forbidden';
    public const AUTHENTICATION_FAILED = 'Authentication failed';
    
    public const LOCATION_NOT_FOUND = 'Location not fount';

    public const LOCATION_ALREADY_EXISTS = 'Location already exists';
    public const CONTAINER_ALREADY_EXISTS = 'Container already exists';
    public const ROLE_NOT_FOUND = 'Role not found';

    public const PHYSICAL_TAG_NOT_FOUND = 'Physical tag not found';
    public const PHYSICAL_TAG_MUST_BE_FREE = 'PhysicalTag Status must be Free';
    public const PHYSICAL_TAG_ALREADY_EXISTS = 'Physical tag already exists';
}