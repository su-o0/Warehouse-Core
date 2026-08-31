<?php
namespace WarehouseCore\Exception;

use WarehouseCore\Contract\Exception as ExceptionContract;

final class DomainException extends ExceptionContract {

    public static function AREA_NOT_FOUND(): self {
        return new self(
            ErrorCode::AREA_NOT_FOUND,
            ErrorMessage::AREA_NOT_FOUND
        );
    }

    public static function PROVIDER_NAME_INVALID_TYPE(): self {
        return new self(
            ErrorCode::PROVIDER_NAME_INVALID_TYPE,
            ErrorMessage::PROVIDER_NAME_INVALID_TYPE
        );
    }

    public static function ITEM_PROCESSING_STEP_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_PROCESSING_STEP_NOT_FOUND,
            ErrorMessage::ITEM_PROCESSING_STEP_NOT_FOUND
        );
    }

    public static function PART_PROCESSING_STEP_NOT_FOUND(): self {
        return new self(
            ErrorCode::PART_PROCESSING_STEP_NOT_FOUND,
            ErrorMessage::PART_PROCESSING_STEP_NOT_FOUND
        );
    }

    public static function USER_PROCESSING_STEP_NOT_FOUND(): self {
        return new self(
            ErrorCode::USER_PROCESSING_STEP_NOT_FOUND,
            ErrorMessage::USER_PROCESSING_STEP_NOT_FOUND
        );
    }


    public static function CONTAINER_TYPE_INVALID_TYPE(): self {
        return new self(
            ErrorCode::CONTAINER_TYPE_INVALID_TYPE,
            ErrorMessage::CONTAINER_TYPE_INVALID_TYPE
        );
    }

    public static function CONTAINER_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::CONTAINER_STATUS_INVALID_TYPE,
            ErrorMessage::CONTAINER_TYPE_INVALID_TYPE
        );
    }

    public static function PLACEMENT_TARGET_INVALID_TYPE(): self {
        return new self(
            ErrorCode::PLACEMENT_TARGET_INVALID_TYPE,
            ErrorMessage::PLACEMENT_TARGET_INVALID_TYPE
        );
    }

    public static function PLACEMENT_ENTITY_INVALID_TYPE(): self {
        return new self(
            ErrorCode::PLACEMENT_ENTITY_INVALID_TYPE,
            ErrorMessage::PLACEMENT_ENTITY_INVALID_TYPE
        );
    }

    public static function LOCATION_INVALID_STATUS(): self {
        return new self(
            ErrorCode::LOCATION_INVALID_STATUS,
            ErrorMessage::LOCATION_INVALID_STATUS
        );
    }

    public static function ITEM_PROCESSING_STEP_STAGE_INVALID_TYPE(): self {
        return new self(
            ErrorCode::ITEM_PROCESSING_STEP_STAGE_INVALID_TYPE,
            ErrorMessage::ITEM_PROCESSING_STEP_STAGE_INVALID_TYPE
        );
    }

    public static function PART_PROCESSING_STEP_STAGE_INVALID_TYPE(): self {
        return new self(
            ErrorCode::PART_PROCESSING_STEP_STAGE_INVALID_TYPE,
            ErrorMessage::PART_PROCESSING_STEP_STAGE_INVALID_TYPE
        );
    }

    public static function USER_PROCESSING_STEP_STAGE_INVALID_TYPE(): self {
        return new self(
            ErrorCode::USER_PROCESSING_STEP_STAGE_INVALID_TYPE,
            ErrorMessage::USER_PROCESSING_STEP_STAGE_INVALID_TYPE
        );
    }

    public static function ROLE_NOT_FOUND(): self {
        return new self(
            ErrorCode::ROLE_NOT_FOUND,
            ErrorMessage::ROLE_NOT_FOUND
        );
    }

    public static function PROVIDER_NOT_FOUND(): self {
        return new self(
            ErrorCode::PROVIDER_NOT_FOUND,
            ErrorMessage::PROVIDER_NOT_FOUND
        );
    }
    
    public static function ROLE_NAME_INVALID_TYPE(): self {
        return new self(
            ErrorCode::ROLE_NAME_INVALID_TYPE,
            ErrorMessage::ROLE_NAME_INVALID_TYPE
        );
    }

    public static function TELEMETRY_INVALID_TYPE(): self {
        return new self(
            ErrorCode::TELEMETRY_INVALID_TYPE,
            ErrorMessage::TELEMETRY_INVALID_TYPE
        );
    }

    public static function TELEMETRY_ACTION_INVALID_TYPE(): self {
        return new self(
            ErrorCode::TELEMETRY_ACTION_INVALID_TYPE,
            ErrorMessage::TELEMETRY_ACTION_INVALID_TYPE
        );
    }

    public static function LOCATION_ADDRESS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::LOCATION_ADDRESS_INVALID_TYPE,
            ErrorMessage::LOCATION_ADDRESS_INVALID_TYPE
        );
    }
    
    public static function CONTAINER_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::CONTAINER_ALREADY_EXISTS,
            ErrorMessage::CONTAINER_ALREADY_EXISTS
        );
    }

    public static function CONTAINER_NOT_FOUND(): self {
        return new self(
            ErrorCode::CONTAINER_NOT_FOUND,
            ErrorMessage::CONTAINER_NOT_FOUND
        );
    }
    
    public static function CONTAINER_PLACEMENT_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_ALREADY_EXISTS,
            ErrorMessage::CONTAINER_PLACEMENT_ALREADY_EXISTS
        );
    }

    public static function CONTAINER_PLACEMENT_NOT_FOUND(): self {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_NOT_FOUND,
            ErrorMessage::CONTAINER_PLACEMENT_NOT_FOUND
        );
    }

    public static function ITEM_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_NOT_FOUND,
            ErrorMessage::ITEM_NOT_FOUND
        );
    }

    public static function AREA_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::AREA_STATUS_INVALID_TYPE,
            ErrorMessage::AREA_STATUS_INVALID_TYPE
        );
    }

    public static function PART_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::PART_STATUS_INVALID_TYPE,
            ErrorMessage::PART_STATUS_INVALID_TYPE
        );
    }

    public static function ZONE_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::ZONE_STATUS_INVALID_TYPE,
            ErrorMessage::ZONE_STATUS_INVALID_TYPE
        );
    }

    public static function RACK_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::RACK_STATUS_INVALID_TYPE,
            ErrorMessage::RACK_STATUS_INVALID_TYPE
        );
    }

    public static function USER_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::USER_STATUS_INVALID_TYPE,
            ErrorMessage::USER_STATUS_INVALID_TYPE
        );
    }

    public static function OWNER_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::OWNER_STATUS_INVALID_TYPE,
            ErrorMessage::OWNER_STATUS_INVALID_TYPE
        );
    }

    public static function ITEM_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::ITEM_STATUS_INVALID_TYPE,
            ErrorMessage::ITEM_STATUS_INVALID_TYPE
        );
    }

    public static function ITEM_CONDITION_INVALID_TYPE(): self {
        return new self(
            ErrorCode::ITEM_CONDITION_INVALID_TYPE,
            ErrorMessage::ITEM_CONDITION_INVALID_TYPE
        );
    }

    public static function ITEM_PHOTO_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::ITEM_PHOTO_ALREADY_EXISTS,
            ErrorMessage::ITEM_PHOTO_ALREADY_EXISTS,
        );
    }

    public static function ITEM_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_PHOTO_NOT_FOUND,
            ErrorMessage::ITEM_PHOTO_NOT_FOUND,
        );
    }

    public static function ITEM_PLACEMENT_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_PLACEMENT_NOT_FOUND,
            ErrorMessage::ITEM_PLACEMENT_NOT_FOUND,
        );
    }
    
    public static function STOCK_PLACEMENT_NOT_FOUND(): self {
        return new self(
            ErrorCode::STOCK_PLACEMENT_NOT_FOUND,
            ErrorMessage::STOCK_PLACEMENT_NOT_FOUND,
        );
    }

    public static function LOCATION_NOT_FOUND(): self {
        return new self(
            ErrorCode::LOCATION_NOT_FOUND,
            ErrorMessage::LOCATION_NOT_FOUND
        );
    }
    public static function OWNER_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::OWNER_ALREADY_EXISTS,
            ErrorMessage::OWNER_ALREADY_EXISTS
        );
    }

    public static function OWNER_NOT_FOUND(): self {
        return new self(
            ErrorCode::OWNER_NOT_FOUND,
            ErrorMessage::OWNER_NOT_FOUND
        );
    }

    public static function PART_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::PART_ALREADY_EXISTS,
            ErrorMessage::PART_ALREADY_EXISTS
        );
    }

    public static function PART_NOT_FOUND(): self {
        return new self(
            ErrorCode::PART_NOT_FOUND,
            ErrorMessage::PART_NOT_FOUND
        );
    }

    public static function PHYSICAL_TAG_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_ALREADY_EXISTS,
            ErrorMessage::PHYSICAL_TAG_ALREADY_EXISTS
        );
    }

    public static function PHYSICAL_TAG_NOT_FOUND(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_NOT_FOUND,
            ErrorMessage::PHYSICAL_TAG_NOT_FOUND
        );
    }

    public static function RACK_NOT_FOUND(): self {
        return new self(
            ErrorCode::RACK_NOT_FOUND,
            ErrorMessage::RACK_NOT_FOUND
        );
    }

    public static function SHELF_NOT_FOUND(): self {
        return new self(
            ErrorCode::SHELF_NOT_FOUND,
            ErrorMessage::SHELF_NOT_FOUND
        );
    }

    public static function STORED_FILE_NOT_FOUND(): self {
        return new self(
            ErrorCode::STORED_FILE_NOT_FOUND,
            ErrorMessage::STORED_FILE_NOT_FOUND
        );
    }

    public static function USER_IDENTITY_NOT_FOUND(): self {
        return new self(
            ErrorCode::USER_IDENTITY_NOT_FOUND,
            ErrorMessage::USER_IDENTITY_NOT_FOUND
        );
    }

    public static function ZONE_NOT_FOUND(): self {
        return new self(
            ErrorCode::ZONE_NOT_FOUND,
            ErrorMessage::ZONE_NOT_FOUND
        );
    }

    public static function PHYSICAL_TAG_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_STATUS_INVALID_TYPE,
            ErrorMessage::PHYSICAL_TAG_STATUS_INVALID_TYPE,
        );
    }

    public static function STOCK_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::STOCK_ALREADY_EXISTS,
            ErrorMessage::STOCK_ALREADY_EXISTS
        );
    }

    public static function STOCK_NOT_FOUND(): self {
        return new self(
            ErrorCode::STOCK_NOT_FOUND,
            ErrorMessage::STOCK_NOT_FOUND
        );
    }

    public static function STOCK_STATUS_INVALID_TYPE(): self {
        return new self(
            ErrorCode::STOCK_STATUS_INVALID_TYPE,
            ErrorMessage::STOCK_STATUS_INVALID_TYPE
        );
    }
    
    public static function STOCK_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::STOCK_PHOTO_NOT_FOUND,
            ErrorMessage::STOCK_PHOTO_NOT_FOUND
        );
    }

     public static function VEHICLE_PHOTO_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::VEHICLE_PHOTO_ALREADY_EXISTS,
            ErrorMessage::VEHICLE_PHOTO_ALREADY_EXISTS
        );
    }

    public static function VEHICLE_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::VEHICLE_PHOTO_NOT_FOUND,
            ErrorMessage::VEHICLE_PHOTO_NOT_FOUND,
        );
    }
     public static function VEHICLE_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::VEHICLE_ALREADY_EXISTS,
            ErrorMessage::VEHICLE_ALREADY_EXISTS
        );
    }

    public static function VEHICLE_NOT_FOUND(): self {
        return new self(
            ErrorCode::VEHICLE_NOT_FOUND,
            ErrorMessage::VEHICLE_NOT_FOUND
        );
    }

    public static function USER_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::USER_ALREADY_EXISTS,
            ErrorMessage::USER_ALREADY_EXISTS,
        );
    }

    public static function USER_NOT_FOUND(): self {
        return new self(
            ErrorCode::USER_NOT_FOUND,
            ErrorMessage::USER_NOT_FOUND,
        );
    }
}