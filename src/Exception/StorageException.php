<?php 
namespace SuO0\StorageApi\Exception;

class StorageException extends \RuntimeException {

    public function __construct(
        public readonly string $errorCode,
        string $message
    ) {
        parent::__construct($message);
    }

    public static function DB_CONNECTION_ERROR(): self {
        return new self(
            ErrorCode::DB_CONNECTION_ERROR,
            'Database connection error occurred'
        );
    }

    public static function DB_QUERY_ERROR(): self {
        return new self(
            ErrorCode::DB_DUPLICATE_ERROR,
            'Database duplicate entry error occurred'
        );
    }

    public static function DB_RELATION_ERROR(): self {
        return new self(
            ErrorCode::DB_RELATION_ERROR,
            'Database relation error occurred'
        );
    }

    public static function DB_DUPLICATE_ERROR(): self {
        return new self(
            ErrorCode::DB_DUPLICATE_ERROR,
            'Database duplicate entry error occurred'
        );
    }

    public static function DB_UNKNOWN_ERROR(): self {
        return new self(
            ErrorCode::DB_UNKNOWN_ERROR,
            'Unknown database error occurred'
        );
    }

    // Location

    public static function LOCATION_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::LOCATION_ALREADY_EXISTS,
            'Location with the same address already exists'
        );
    }

    public static function LOCATION_NOT_FOUND(): self {
        return new self(
            ErrorCode::LOCATION_NOT_FOUND,
            'Location not found'
        );
    }

    public static function CONTAINER_PLACEMENT_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_ALREADY_EXISTS,
            'Container placement already exists'
        );
    }

    public static function CONTAINER_PLACEMENT_NOT_FOUND(): self {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_NOT_FOUND,
            'Container placement not found'
        );
    }

    public static function CONTAINER_INVALID_TYPE(): self {
        return new self(
            ErrorCode::CONTAINER_INVALID_TYPE,
            'Container type must be Box or Pallet'
        );
    }
    
    public static function STOCK_PLACEMENT_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::STOCK_PLACEMENT_ALREADY_EXISTS,
            'Stock placement already exists'
        );
    }

    public static function STOCK_PLACEMENT_NOT_FOUND(): self {
        return new self(
            ErrorCode::STOCK_PLACEMENT_NOT_FOUND,
            'Stock placement not found'
        );
    }

    public static function ITEM_PLACEMENT_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::ITEM_PLACEMENT_ALREADY_EXISTS,
            'Item placement already exists'
        );
    }

    public static function ITEM_PLACEMENT_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_PLACEMENT_NOT_FOUND,
            'Item placement not found'
        );
    }

    public static function PHYSICAL_TAG_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_ALREADY_EXISTS,
            'Physical tag already exists'
        );
    }

    public static function PHYSICAL_TAG_NOT_FOUND(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_NOT_FOUND,
            'Physical tag not found'
        );
    }

    public static function PHYSICAL_TAG_INVALID_STATUS(): self {
        return new self(
            ErrorCode::PHYSICAL_TAG_INVALID_STATUS,
            'PhysicalTag Status must be Free, Assigned, Lost or Broken'
        );
    }

    public static function CONTAINER_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::CONTAINER_ALREADY_EXISTS,
            'Container already exists'
        );
    }

    public static function CONTAINER_NOT_FOUND(): self {
        return new self(
            ErrorCode::CONTAINER_NOT_FOUND,
            'Container not found'
        );
    }

    public static function ITEM_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::ITEM_ALREADY_EXISTS,
            'Item already exists'
        );
    }

    public static function ITEM_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_NOT_FOUND,
            'Item not found'
        );
    }

    public static function ITEM_INVALID_STATUS(): self {
        return new self(
            ErrorCode::ITEM_INVALID_STATUS,
            'Item status must be Active|Sold|Archived|Lost'
        );
    }

    public static function ITEM_INVALID_CONDITION(): self {
        return new self(
            ErrorCode::ITEM_INVALID_CONDITION,
            'Item condition must be New|Good|Fair|Poor'
        );
    }

    public static function ITEM_PHYSICAL_TAG_ALREADY_USED(): self {
        return new self(
            ErrorCode::ITEM_PHYSICAL_TAG_ALREADY_USED,
            'Physical tag is already assigned to another active item'
        );
    }

    public static function STOCK_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::STOCK_ALREADY_EXISTS,
            'Stock already exists'
        );
    }

    public static function STOCK_NOT_FOUND(): self {
        return new self(
            ErrorCode::STOCK_NOT_FOUND,
            'Stock not found'
        );
    }

    public static function OWNER_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::OWNER_ALREADY_EXISTS,
            'Owner already exists'
        );
    }

    public static function OWNER_NOT_FOUND(): self {
        return new self(
            ErrorCode::OWNER_NOT_FOUND,
            'Owner not found'
        );
    }

    public static function OWNER_INVALID_PERMISSION(): self {
        return new self(
            ErrorCode::OWNER_INVALID_PERMISSION,
            'Permission must be Admin|Worker|Salesman'
        );
    }

    public static function OWNER_USERID_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::OWNER_USERID_ALREADY_EXISTS,
            'Owner with the same UserId already exists'
        );
    }
    
    public static function OWNER_NAME_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::OWNER_NAME_ALREADY_EXISTS,
            'Owner with the same Name already exists'
        );
    }
    
    public static function PART_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::PART_ALREADY_EXISTS,
            'Part already exists'
        );
    }

    public static function PART_NOT_FOUND(): self {
        return new self(
            ErrorCode::PART_NOT_FOUND,
            'Part not found'
        );
    }

    public static function CAR_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::CAR_ALREADY_EXISTS,
            'Car already exists'
        );
    }

    public static function CAR_NOT_FOUND(): self {
        return new self(
            ErrorCode::CAR_NOT_FOUND,
            'Car not found'
        );
    }

    public static function ITEM_PHOTO_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::ITEM_PHOTO_ALREADY_EXISTS,
            'Item photo already exists'
        );
    }

    public static function ITEM_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::ITEM_PHOTO_NOT_FOUND,
            'Item photo not found'
        );
    }

    public static function STOCK_PHOTO_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::STOCK_PHOTO_ALREADY_EXISTS,
            'Stock photo already exists'
        );
    }

    public static function STOCK_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::STOCK_PHOTO_NOT_FOUND,
            'Stock photo not found'
        );
    }

    public static function CAR_PHOTO_ALREADY_EXISTS(): self {
        return new self(
            ErrorCode::CAR_PHOTO_ALREADY_EXISTS,
            'Car photo already exists'
        );
    }

    public static function CAR_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::CAR_PHOTO_NOT_FOUND,
            'Car photo not found'
        );
    }

    public static function SALES_ARCHIVE_PHOTO_NOT_FOUND(): self {
        return new self(
            ErrorCode::SALES_ARCHIVE_PHOTO_NOT_FOUND,
            'Sales archive photo not found'
        );
    }

    public static function HISTORY_NOT_FOUND(): self {
        return new self(
            ErrorCode::HISTORY_NOT_FOUND,
            'History not found'
        );
    }

    public static function PERMISSION_DENIED(): self {
        return new self(
            ErrorCode::PERMISSION_DENIED,
            'Permission denied'
        );
    }
}