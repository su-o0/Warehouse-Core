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
    public const USER_PROCESSING_STEP_ALREADY_EXISTS = 'User processing step already exists';
    
    public const USER_ROLE_ALREADY_SET = 'User role is already set';

    public const STOCK_ALREADY_EXISTS = 'Stock already exists';
    public const USER_ALREADY_EXISTS = 'User already exists';
    public const PART_ALREADY_EXISTS = 'Part already exists';
    public const OWNER_ALREADY_EXISTS = 'Owner already exists';
    public const CONTAINER_PLACEMENT_ALREADY_EXISTS = 'Container placement already exists';
    public const ITEM_PHOTO_ALREADY_EXISTS = 'Item photo already exists';
    public const CONTAINER_ALREADY_EXISTS = 'Container already exists';
    public const AREA_ACCESS_ALREADY_EXISTS = 'Area access already exists';

    public const AREA_NAME_ALREADY_PRIMARY = 'Area name already primary';
    public const ZONE_NAME_ALREADY_PRIMARY = 'Zone name already primary';
    public const RACK_NAME_ALREADY_PRIMARY = 'Rack name already primary';
    public const USER_NAME_ALREADY_PRIMARY = 'User name already primary';

    public const AREA_NAME_ALREADY_EXISTS = 'Area name already exists';
    public const ZONE_NAME_ALREADY_EXISTS = 'Zone name already exists';
    public const USER_NAME_ALREADY_EXISTS = 'User name already exists';
    public const RACK_NAME_ALREADY_EXISTS = 'Rack name already exists';
    public const USER_IDENTITY_ALREADY_EXISTS = 'User identity already exists';

    public const AREA_NOT_FOUND = 'Area not found';
    public const ITEM_PROCESSING_STEP_NOT_FOUND  = 'Item processing step not found';
    public const PART_PROCESSING_STEP_NOT_FOUND  = 'Part processing step not found';
    public const USER_PROCESSING_STEP_NOT_FOUND  = 'User processing step not found';
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
    public const PROVIDER_NOT_FOUND = 'Provider not found';
    public const PHYSICAL_TAG_NOT_FOUND = 'Physical tag not found';
    public const RACK_NOT_FOUND = 'Rack not found';
    public const SHELF_NOT_FOUND = 'Shelf not found';
    public const STORED_FILE_NOT_FOUND = 'Stored file not found';
    public const USER_IDENTITY_NOT_FOUND = 'User identity not found';
    public const ZONE_NOT_FOUND = 'Zone not found';
    public const AREA_NAME_NOT_FOUND = 'Area name not found';
    public const ZONE_NAME_NOT_FOUND = 'Zone name not found';
    public const USER_NAME_NOT_FOUND = 'User name not found';
    public const RACK_NAME_NOT_FOUND = 'Rack name not found';
    public const AREA_ACCESS_NOT_FOUND = 'Area access not found';
    public const RENDERER_NOT_FOUND = 'No renderer for result';
    public const USER_ROLE_NOT_FOUND = 'User role not found';
    public const USER_IDENTITIES_NOT_FOUND = 'User identities not found';

    public const PROVIDER_NAME_INVALID_TYPE = 'Provider name must be ...';
    public const PHYSICAL_TAG_STATUS_INVALID_TYPE = 'Physical tag status must ...';
    public const LOCATION_INVALID_STATUS = 'Location status invalid';
    public const LOCATION_ADDRESS_INVALID_TYPE = 'Location address must be Z0>A1>B2';
    public const TELEMETRY_ACTION_INVALID_TYPE = 'Action type must be ...';
    public const TELEMETRY_INVALID_TYPE = 'Telemetry type must be ...';
    public const ROLE_NAME_INVALID_TYPE = 'Role name must be ...';
    public const STOCK_STATUS_INVALID_TYPE  = "Stock status must be ...";
    public const PLACEMENT_TARGET_INVALID_TYPE = 'Placement target must be ...';
    public const PLACEMENT_ENTITY_INVALID_TYPE = 'Placement entity must be ...';
    public const CONTAINER_TYPE_INVALID_TYPE   = 'Container type must be ...';
    public const CONTAINER_STATUS_INVALID_TYPE   = 'Container status must be ...';
    public const ITEM_STATUS_INVALID_TYPE      = 'Item status must be ...';
    public const AREA_STATUS_INVALID_TYPE      = 'Area status must be ...';
    public const PART_STATUS_INVALID_TYPE      = 'Part status must be ...';
    public const ZONE_STATUS_INVALID_TYPE      = 'Zone status must be ...';
    public const RACK_STATUS_INVALID_TYPE      = 'Rack status must be ...';
    public const USER_STATUS_INVALID_TYPE      = 'User status must be ...';
    public const OWNER_STATUS_INVALID_TYPE      = 'User status must be ...';
    public const ITEM_CONDITION_INVALID_TYPE = 'Item condition must be ...';
    public const ITEM_PROCESSING_STEP_STAGE_INVALID_TYPE = 'Item processing stage ...';
    public const PART_PROCESSING_STEP_STAGE_INVALID_TYPE = 'Part processing stage ...';
    public const RACK_PROCESSING_STEP_STAGE_INVALID_TYPE = 'Rack processing stage ...';
    public const USER_PROCESSING_STEP_STAGE_INVALID_TYPE = 'User processing stage ...';


    public const ITEM_ALREADY_PLACED = 'Item already placed';
    public const PHYSICAL_TAG_MUST_BE_FREE = 'PhysicalTag Status must be Free';
    public const PHYSICAL_TAG_ALREADY_EXISTS = 'Physical tag already exists';


    public const AREA_INVALID_STATUS_TRANSITION = 'Area invalid status transition'; //007
    public const ZONE_INVALID_STATUS_TRANSITION = 'Zone invalid status transition'; //007
    public const USER_INVALID_STATUS_TRANSITION = 'User invalid status transition'; //007

    public const USER_PROCESSING_NOT_COMPLETED = 'User invalid status transition'; //007
    
}