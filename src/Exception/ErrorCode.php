<?php

namespace WarehouseCore\Exception;

final class ErrorCode
{

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
    public const SERVICE_NOT_FOUND = 'SERVICE_001';

    public const DB_CONNECTION_ERROR = 'DB_CONNECTION_004';
    public const DB_QUERY_ERROR      = 'DB_QUERY_004';
    public const DB_RELATION_ERROR   = 'DB_RELATION_004'; //1452 1451 
    public const DB_DUPLICATE_ERROR  = 'DB_DUPLICATE_004';
    public const DB_UNKNOWN_ERROR    = 'DB_UNKNOWN_004';

    //--REPOSITORY-- 

    // Location
    public const LOCATION_ALREADY_EXISTS    = 'LOCATION_ADDRESS_001';
    public const LOCATION_NOT_FOUND         = 'LOCATION_002';


    public const CONTAINER_PLACEMENT_ALREADY_EXISTS = 'CONTAINER_PLACEMENT_001';
    public const CONTAINER_PLACEMENT_NOT_FOUND      = 'CONTAINER_PLACEMENT_002';


    public const STOCK_PLACEMENT_ALREADY_EXISTS = 'STOCK_PLACEMENT_001';
    public const STOCK_PLACEMENT_NOT_FOUND      = 'STOCK_PLACEMENT_002';


    public const ITEM_PLACEMENT_ALREADY_EXISTS  = 'ITEM_PLACEMENT_001';
    public const ITEM_PLACEMENT_NOT_FOUND       = 'ITEM_PLACEMENT_002';


    public const PHYSICAL_TAG_ALREADY_EXISTS    = 'PHYSICAL_TAG_001';
    public const PHYSICAL_TAG_NOT_FOUND         = 'PHYSICAL_TAG_002';
    public const PHYSICAL_TAG_INVALID_STATUS    = 'PHYSICAL_TAG_007';


    public const CONTAINER_ALREADY_EXISTS   = 'CONTAINER_001';
    public const CONTAINER_NOT_FOUND        = 'CONTAINER_002';
    public const CONTAINER_INVALID_TYPE     = 'CONTAINER_007';


    public const ITEM_ALREADY_EXISTS            = 'ITEM_001';
    public const ITEM_NOT_FOUND                 = 'ITEM_002';
    public const ITEM_INVALID_STATUS            = 'ITEM_007';
    public const ITEM_INVALID_CONDITION         = 'ITEM_008';
    public const ITEM_PHYSICAL_TAG_ALREADY_USED = 'ITEM_009';


    public const STOCK_ALREADY_EXISTS   = 'STOCK_001';
    public const STOCK_NOT_FOUND        = 'STOCK_002';


    public const OWNER_ALREADY_EXISTS           = 'OWNER_001';
    public const OWNER_NOT_FOUND                = 'OWNER_002';
    public const OWNER_INVALID_PERMISSION       = 'OWNER_003';
    public const OWNER_USERID_ALREADY_EXISTS    = 'OWNER_004';
    public const OWNER_NAME_ALREADY_EXISTS      = 'OWNER_005';

    public const PART_ALREADY_EXISTS    = 'PART_001';
    public const PART_NOT_FOUND         = 'PART_002';


    public const VEHICLE_ALREADY_EXISTS     = 'VEHICLE_001';
    public const VEHICLE_NOT_FOUND          = 'VEHICLE_002';


    public const ITEM_PHOTO_ALREADY_EXISTS      = 'ITEM_PHOTO_001';
    public const ITEM_PHOTO_NOT_FOUND           = 'ITEM_PHOTO_002';


    public const STOCK_PHOTO_ALREADY_EXISTS     = 'STOCK_PHOTO_001';
    public const STOCK_PHOTO_NOT_FOUND          = 'STOCK_PHOTO_002';


    public const VEHICLE_PHOTO_ALREADY_EXISTS       = 'VEHICLE_PHOTO_001';
    public const VEHICLE_PHOTO_NOT_FOUND            = 'VEHICLE_PHOTO_002';

    public const SALES_ARCHIVE_PHOTO_NOT_FOUND  = 'SALES_ARCHIVE_PHOTO_002';


    public const HISTORY_NOT_FOUND              = 'HISTORY_002';

    public const PERMISSION_DENIED            = 'PERMISSION_006';



    public const TAG_ALREADY_ASSIGNED  = 'TAG_001';
}
