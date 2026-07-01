<?php

namespace WarehouseCore\Exception;

use WarehouseCore\Exception\Contract\DomainException as DomainExceptionContract;

final class DomainException extends DomainExceptionContract 
{
    public static function CONTAINER_INVALID_TYPE(): self
    {
        return new self(
            ErrorCode::CONTAINER_INVALID_TYPE,
            'Container type must be Box or Pallet'
        );
    }

    public static function CONTAINER_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::CONTAINER_ALREADY_EXISTS,
            'Container already exists'
        );
    }

    public static function CONTAINER_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::CONTAINER_NOT_FOUND,
            'Container not found'
        );
    }
    
public static function CONTAINER_PLACEMENT_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_ALREADY_EXISTS,
            'Container placement already exists'
        );
    }

    public static function CONTAINER_PLACEMENT_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::CONTAINER_PLACEMENT_NOT_FOUND,
            'Container placement not found'
        );
    }
     public static function ITEM_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::ITEM_ALREADY_EXISTS,
            'Item already exists'
        );
    }

    public static function ITEM_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::ITEM_NOT_FOUND,
            'Item not found'
        );
    }

    public static function ITEM_INVALID_STATUS(): self
    {
        return new self(
            ErrorCode::ITEM_INVALID_STATUS,
            'Item status must be Created|Tagged|Placed|Active|Sold|Archived|Lost'
        );
    }

    public static function ITEM_INVALID_CONDITION(): self
    {
        return new self(
            ErrorCode::ITEM_INVALID_CONDITION,
            'Item condition must be New|Good|Fair|Poor'
        );
    }

    public static function ITEM_PHYSICAL_TAG_ALREADY_USED(): self
    {
        return new self(
            ErrorCode::ITEM_PHYSICAL_TAG_ALREADY_USED,
            'Physical tag is already assigned to another active item'
        );
    }

     public static function ITEM_PHOTO_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::ITEM_PHOTO_ALREADY_EXISTS,
            'Item photo already exists'
        );
    }

    public static function ITEM_PHOTO_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::ITEM_PHOTO_NOT_FOUND,
            'Item photo not found'
        );
    }

 public static function ITEM_PLACEMENT_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::ITEM_PLACEMENT_ALREADY_EXISTS,
            'Item placement already exists'
        );
    }

    public static function ITEM_PLACEMENT_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::ITEM_PLACEMENT_NOT_FOUND,
            'Item placement not found'
        );
    }
    public static function LOCATION_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::LOCATION_NOT_FOUND,
            'Location not found'
        );
    }
public static function OWNER_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::OWNER_ALREADY_EXISTS,
            'Owner already exists'
        );
    }

    public static function OWNER_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::OWNER_NOT_FOUND,
            'Owner not found'
        );
    }

    public static function OWNER_INVALID_PERMISSION(): self
    {
        return new self(
            ErrorCode::OWNER_INVALID_PERMISSION,
            'Permission must be Admin|Worker|Salesman'
        );
    }

    public static function OWNER_USERID_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::OWNER_USERID_ALREADY_EXISTS,
            'Owner with the same UserId already exists'
        );
    }

    public static function OWNER_NAME_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::OWNER_NAME_ALREADY_EXISTS,
            'Owner with the same Name already exists'
        );
    }
public static function PART_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::PART_ALREADY_EXISTS,
            'Part already exists'
        );
    }

    public static function PART_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::PART_NOT_FOUND,
            'Part not found'
        );
    }

 public static function PHYSICAL_TAG_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::PHYSICAL_TAG_ALREADY_EXISTS,
            'Physical tag already exists'
        );
    }

    public static function PHYSICAL_TAG_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::PHYSICAL_TAG_NOT_FOUND,
            'Physical tag not found'
        );
    }

    public static function PHYSICAL_TAG_INVALID_STATUS(): self
    {
        return new self(
            ErrorCode::PHYSICAL_TAG_INVALID_STATUS,
            'PhysicalTag Status must be Free, Assigned, Lost or Broken'
        );
    }
 public static function STOCK_PLACEMENT_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::STOCK_PLACEMENT_ALREADY_EXISTS,
            'Stock placement already exists'
        );
    }

    public static function STOCK_PLACEMENT_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::STOCK_PLACEMENT_NOT_FOUND,
            'Stock placement not found'
        );
    }

    public static function STOCK_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::STOCK_ALREADY_EXISTS,
            'Stock already exists'
        );
    }

    public static function STOCK_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::STOCK_NOT_FOUND,
            'Stock not found'
        );
    }

    public static function STOCK_INVALID_STATUS(): self
    {
        return new self(
            ErrorCode::ITEM_INVALID_STATUS,
            'Stock status must be Created|Placed|Active|Adjusted|Crowded|Archived'
        );
    }
    public static function LOCATION_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::LOCATION_ALREADY_EXISTS,
            'Location with the same address already exists'
        );
    }

     public static function STOCK_PHOTO_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::STOCK_PHOTO_ALREADY_EXISTS,
            'Stock photo already exists'
        );
    }

    public static function STOCK_PHOTO_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::STOCK_PHOTO_NOT_FOUND,
            'Stock photo not found'
        );
    }

     public static function VEHICLE_PHOTO_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::VEHICLE_PHOTO_ALREADY_EXISTS,
            'Car photo already exists'
        );
    }

    public static function VEHICLE_PHOTO_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::VEHICLE_PHOTO_NOT_FOUND,
            'Car photo not found'
        );
    }
     public static function VEHICLE_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::VEHICLE_ALREADY_EXISTS,
            'Car already exists'
        );
    }

    public static function VEHICLE_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::VEHICLE_NOT_FOUND,
            'Vehicle not found'
        );
    }

    public static function USER_ALREADY_EXISTS(): self
    {
        return new self(
            ErrorCode::USER_ALREADY_EXISTS,
            'User already exists'
        );
    }

    public static function USER_NOT_FOUND(): self
    {
        return new self(
            ErrorCode::USER_NOT_FOUND,
            'User not found'
        );
    }

    public static function PHYSICAL_TAG_NOT_AVAILABLE(): self
    {
        return new self(
            ErrorCode::PHYSICAL_TAG_NOT_AVAILABLE,
            'Physical tag is not available for assignment. Choose another tag.'
        );
    }

}