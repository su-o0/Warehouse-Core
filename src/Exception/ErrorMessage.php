<?php
namespace WarehouseCore\Exception;

final class ErrorMessage {
    // 001 - already exists
    // 002 - not found
    // 003 - invalid input
    // 004 - database error
    // 005 - external service error
    // 006 - permission denied
    // 007 - validation error
    // 008 - authentication error
    // 009 - rate limit exceeded
    // 010 - unknown error

    public const SERVICE_UNAVAILABLE = 'Service temporarily unavailable';
    public const FORBIDDEN = 'Forbidden';
    public const AUTHENTICATION_FAILED = 'Authentication failed';
    
    public const VEHICLE_ALREADY_EXISTS = 'Car already exists';

    public const VEHICLE_PHOTO_ALREADY_EXISTS = 'Car photo already exists';

    public const STOCK_ALREADY_EXISTS = 'Stock already exists';
    public const USER_ALREADY_EXISTS = 'User already exists';
    public const PART_ALREADY_EXISTS = 'Part already exists';
    public const OWNER_ALREADY_EXISTS = 'Owner already exists';
    public const CONTAINER_PLACEMENT_ALREADY_EXISTS = 'Container placement already exists';
    public const ITEM_PHOTO_ALREADY_EXISTS = 'Item photo already exists';
    public const LOCATION_ALREADY_EXISTS = 'Location already exists';
    public const CONTAINER_ALREADY_EXISTS = 'Container already exists';

    public const STOCK_PHOTO_NOT_FOUND = 'Stock photo not found';
    public const VEHICLE_PHOTO_NOT_FOUND = 'Vehicle photo not found';
    public const VEHICLE_NOT_FOUND = 'Vehicle not found';
    public const USER_NOT_FOUND = 'User not found';
    public const PART_NOT_FOUND = 'Part not found';
    public const OWNER_NOT_FOUND = 'Owner not found';
    public const ITEM_PHOTO_NOT_FOUND = 'Item photo not found';
    public const ITEM_NOT_FOUND = 'Item not found';
    public const CONTAINER_PLACEMENT_NOT_FOUND = 'Container placement not found';
    public const ITEM_PLACEMENT_NOT_FOUND = 'Item placement not found';
    public const STOCK_PLACEMENT_NOT_FOUND = 'Stock placement not found';
    public const STOCK_NOT_FOUND    = 'Stock not found';
    public const LOCATION_NOT_FOUND = 'Location not found';
    public const CONTAINER_NOT_FOUND = 'Container not found';
    public const ROLE_NOT_FOUND = 'Role not found';
    public const PHYSICAL_TAG_NOT_FOUND = 'Physical tag not found';


    public const PROVIDER_TYPE_INVALID_TYPE = 'Provider type must be ...';
    public const PHYSICAL_TAG_STATUS_INVALID_TYPE = 'Physical tag status must be Free|Assigned|Lost|Broken';
    public const LOCATION_INVALID_STATUS = 'Location status invalid';
    public const LOCATION_ADDRESS_INVALID_TYPE = 'Location address must be Z0>A1>B2';
    public const TELEMETRY_ACTION_INVALID_TYPE = 'Action type must be ...';
    public const TELEMETRY_INVALID_TYPE = 'Telemetry type must be ...';
    public const ROLE_NAME_INVALID_TYPE = 'Role name must be ...';
    public const STOCK_STATUS_INVALID_TYPE  = "Stock status must be Created|Active|Crowded|Archived";
    public const PLACEMENT_TARGET_INVALID_TYPE = 'Placement target must be Location|Container';
    public const PLACEMENT_ENTITY_INVALID_TYPE = 'Placement entity must be Container|Item|Stock';
    public const CONTAINER_TYPE_INVALID_TYPE   = 'Container type must be Created|Active|Crowded|Archived|Lost';
    public const ITEM_STATUS_INVALID_TYPE      = 'Item status must be Created|Processing|Active|Sold|Archived|Lost';
    public const ITEM_CONDITION_INVALID_TYPE = 'Item condition must be New|Good|Fair|Poor';
    public const ITEM_PROCESSING_STAGE_INVALID_TYPE = 'Item processing stage must be Identify|Photo|Inspection|Placement';


    public const PHYSICAL_TAG_MUST_BE_FREE = 'PhysicalTag Status must be Free';
    public const PHYSICAL_TAG_ALREADY_EXISTS = 'Physical tag already exists';
}