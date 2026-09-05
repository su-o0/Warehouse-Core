<?php

namespace WarehouseCore\Exception;

final class ErrorCode {
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
    public const AUTHENTICATION_FAILED = 'SERVICE_007';
    public const FORBIDDEN = 'SERVICE_006';

    public const VALIDATION_FIELD_MISSING = 'VALIDATION_002';
    public const VALIDATION_INVALID_TYPE = 'VALIDATION_003';

    // Location

    public const CONTAINER_PLACEMENT_ALREADY_EXISTS     = 'CONTAINER_PLACEMENT_001';
    public const VEHICLE_ALREADY_EXISTS                 = 'VEHICLE_001';
    public const TAG_ALREADY_ASSIGNED                   = 'TAG_001';
    public const ITEM_PHOTO_ALREADY_EXISTS              = 'ITEM_PHOTO_001';
    public const VEHICLE_PHOTO_ALREADY_EXISTS           = 'VEHICLE_PHOTO_001';
    public const PHYSICAL_TAG_ALREADY_EXISTS            = 'PHYSICAL_TAG_001';
    public const CONTAINER_ALREADY_EXISTS               = 'CONTAINER_001';
    public const STOCK_ALREADY_EXISTS                   = 'STOCK_001';
    public const OWNER_ALREADY_EXISTS                   = 'OWNER_001';
    public const USER_ALREADY_EXISTS                    = 'USER_001';
    public const PART_ALREADY_EXISTS                    = 'PART_001';


    public const AREA_NOT_FOUND                     = 'AREA_002';
    public const ITEM_PROCESSING_STEP_NOT_FOUND     = 'ITEM_PROCESSING_STEP_002';
    public const PART_PROCESSING_STEP_NOT_FOUND     = 'PART_PROCESSING_STEP_002';
    public const USER_PROCESSING_STEP_NOT_FOUND     = 'USER_PROCESSING_STEP_002';
    public const SERVICE_NOT_FOUND                  = 'SERVICE_002';
    public const PHYSICAL_TAG_NOT_FOUND             = 'PHYSICAL_TAG_002';
    public const LOCATION_NOT_FOUND                 = 'LOCATION_002';
    public const CONTAINER_NOT_FOUND                = 'CONTAINER_002';
    public const USER_IDENTITY_NOT_FOUND            = 'USER_IDENTITY_002';
    public const ROLE_NOT_FOUND                     = 'ROLE_002';
    public const PROVIDER_NOT_FOUND                 = 'PROVIDER_002';
    public const ITEM_PLACEMENT_NOT_FOUND           = 'ITEM_PLACEMENT_002';
    public const STOCK_PLACEMENT_NOT_FOUND          = 'STOCK_PLACEMENT_002';
    public const CONTAINER_PLACEMENT_NOT_FOUND      = 'CONTAINER_PLACEMENT_002';
    public const ITEM_NOT_FOUND                     = 'ITEM_002';
    public const STOCK_NOT_FOUND                    = 'STOCK_002';
    public const OWNER_NOT_FOUND                    = 'OWNER_002';
    public const HISTORY_NOT_FOUND                  = 'HISTORY_002';
    public const VEHICLE_NOT_FOUND                  = 'VEHICLE_002';
    public const VEHICLE_PHOTO_NOT_FOUND            = 'VEHICLE_PHOTO_002';
    public const ITEM_PHOTO_NOT_FOUND               = 'ITEM_PHOTO_002';
    public const SALES_ARCHIVE_PHOTO_NOT_FOUND      = 'SALES_ARCHIVE_PHOTO_002';
    public const STOCK_PHOTO_NOT_FOUND              = 'STOCK_PHOTO_002';
    public const USER_NOT_FOUND                     = 'USER_002';
    public const PART_NOT_FOUND                     = 'PART_002';
    public const RACK_NOT_FOUND                     = 'RACK_002';
    public const SHELF_NOT_FOUND                    = 'SHELF_002';
    public const STORED_FILE_NOT_FOUND                    = 'SHELF_002';
    public const ZONE_NOT_FOUND                    = 'SHELF_002';
    public const RENDERER_NOT_FOUND                = 'RENDERER_002';

    public const PROVIDER_NAME_INVALID_TYPE             = 'PROVIDER_003';
    public const TELEMETRY_ACTION_INVALID_TYPE          = 'TELEMETRY_ACTION_003';
    public const TELEMETRY_INVALID_TYPE                 = 'TELEMETRY_003';
    public const STOCK_STATUS_INVALID_TYPE              = 'STOCK_STATUS_003';
    public const ITEM_PROCESSING_STEP_STAGE_INVALID_TYPE   = 'ITEM_PROCESSING_STEP_STAGE_003';
    public const PART_PROCESSING_STEP_STAGE_INVALID_TYPE   = 'PART_PROCESSING_STEP_STAGE_003';
    public const RACK_PROCESSING_STEP_STAGE_INVALID_TYPE   = 'RACK_PROCESSING_STEP_STAGE_003';
    public const USER_PROCESSING_STEP_STAGE_INVALID_TYPE   = 'USER_PROCESSING_STEP_STAGE_003';
    public const CONTAINER_TYPE_INVALID_TYPE            = 'CONTAINER_TYPE_003';
    public const CONTAINER_STATUS_INVALID_TYPE          = 'CONTAINER_STATUS_003';
    public const LOCATION_ADDRESS_INVALID_TYPE          = 'LOCATION_ADDRESS_003';
    public const LOCATION_INVALID_STATUS                = 'LOCATION_STATUS_003';
    public const PLACEMENT_TARGET_INVALID_TYPE          = 'PLACEMENT_TARGET_003';
    public const PLACEMENT_ENTITY_INVALID_TYPE          = 'PLACEMENT_ENTITY_003';
    public const PHYSICAL_TAG_STATUS_INVALID_TYPE       = 'PHYSICAL_TAG_003';
    public const ROLE_NAME_INVALID_TYPE                 = 'ROLE_003';
    public const ITEM_STATUS_INVALID_TYPE               = "ITEM_STATUS_003";
    public const AREA_STATUS_INVALID_TYPE               = "AREA_STATUS_003";
    public const PART_STATUS_INVALID_TYPE               = "PART_STATUS_003";
    public const ZONE_STATUS_INVALID_TYPE               = "ZONE_STATUS_003";
    public const RACK_STATUS_INVALID_TYPE               = "RACK_STATUS_003";
    public const USER_STATUS_INVALID_TYPE               = "USER_STATUS_003";
    public const OWNER_STATUS_INVALID_TYPE              = "OWNER_STATUS_003";
    public const ITEM_CONDITION_INVALID_TYPE            = 'ITEM_CONDITION_003';

    
    public const ITEM_PLACEMENT_INVALID_TARGET          = 'ITEM_PLACEMENT_003';
    public const STOCK_PLACEMENT_INVALID_TARGET         = 'STOCK_PLACEMENT_003';
    public const CONTAINER_PLACEMENT_INVALID_TARGET     = 'CONTAINER_PLACEMENT_003';
    public const RACK_PLACEMENT_INVALID_TARGET          = 'RACK_PLACEMENT_003';

    public const ITEM_MOVEMENT_TO_INVALID_TARGET            = 'ITEM_MOVEMENT_TO_003';
    public const STOCK_MOVEMENT_TO_INVALID_TARGET           = 'STOCK_MOVEMENT_TO_003';
    public const CONTAINER_MOVEMENT_FROM_INVALID_TARGET     = 'CONTAINER_MOVEMENT_FROM_003'; 
    public const RACK_MOVEMENT_FROM_INVALID_TARGET          = 'RACK_MOVEMENT_FROM_003'; 

    public const ITEM_MOVEMENT_FROM_INVALID_TARGET          = 'ITEM_MOVEMENT_FROM_003';
    public const STOCK_MOVEMENT_FROM_INVALID_TARGET         = 'STOCK_MOVEMENT_FROM_003';
    public const CONTAINER_MOVEMENT_TO_INVALID_TARGET       = 'CONTAINER_MOVEMENT_TO_003';
    public const RACK_MOVEMENT_TO_INVALID_TARGET            = 'RACK_MOVEMENT_TO_003'; 


    public const DB_CONNECTION_ERROR = 'DB_CONNECTION_004';
    public const DB_QUERY_ERROR      = 'DB_QUERY_004';
    public const DB_RELATION_ERROR   = 'DB_RELATION_004'; //1452 1451 
    public const DB_DUPLICATE_ERROR  = 'DB_DUPLICATE_004';
    public const DB_UNKNOWN_ERROR    = 'DB_UNKNOWN_004';

    public const PERMISSION_DENIED  = 'PERMISSION_006';
}