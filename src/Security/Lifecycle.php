<?php

namespace WarehouseCore\Security;

use WarehouseCore\Payload\Entity\AreaEntity;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Entity\ZoneEntity;
use WarehouseCore\Payload\Enum\AreaStatusEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Enum\ZoneStatusEnum;

final class Lifecycle 
{
    private const OPERATIONS = [
        'area' => [
            'activate'          => [AreaStatusEnum::Created, AreaStatusEnum::Archived],
            'markAsCrowded'     => [AreaStatusEnum::Active],
            'archive'           => [AreaStatusEnum::Active, AreaStatusEnum::Crowded],
            'addName'           => [AreaStatusEnum::Active, AreaStatusEnum::Crowded],
            'setPrimaryName'    => [AreaStatusEnum::Active, AreaStatusEnum::Crowded],
            'removeName'        => [AreaStatusEnum::Active, AreaStatusEnum::Crowded],
            'grantAccess'       => [AreaStatusEnum::Active, AreaStatusEnum::Crowded],
            'revokeAccess'      => [AreaStatusEnum::Active, AreaStatusEnum::Crowded]
        ],
        'zone' => [
            'activate'          => [ZoneStatusEnum::Created, ZoneStatusEnum::Archived],
            'markAsCrowded'     => [ZoneStatusEnum::Active],
            'archive'           => [ZoneStatusEnum::Active, ZoneStatusEnum::Crowded],
            'addName'           => [ZoneStatusEnum::Active, ZoneStatusEnum::Crowded],
            'setPrimaryName'    => [ZoneStatusEnum::Active, ZoneStatusEnum::Crowded],
            'removeName'        => [ZoneStatusEnum::Active, ZoneStatusEnum::Crowded]
        ],
        'rack' => [
            'populate'          => [RackStatusEnum::Registered],
            'activate'          => [RackStatusEnum::Processing, RackStatusEnum::Archived],
            'archive'           => [RackStatusEnum::Active, RackStatusEnum::Crowded],
            'addName'           => [RackStatusEnum::Active, RackStatusEnum::Crowded],
            'setPrimaryName'    => [RackStatusEnum::Active, RackStatusEnum::Crowded],
            'removeName'        => [RackStatusEnum::Active, RackStatusEnum::Crowded]
        ],
        'user' => [
            'activate'          => [UserStatusEnum::Processing, UserStatusEnum::Archived],
            'archive'           => [UserStatusEnum::Active],
            'addName'           => [UserStatusEnum::Created, UserStatusEnum::Processing, UserStatusEnum::Active],
            'setPrimaryName'    => [UserStatusEnum::Processing, UserStatusEnum::Active],
            'removeName'        => [UserStatusEnum::Processing, UserStatusEnum::Active],
            'assignRole'        => [UserStatusEnum::Created, UserStatusEnum::Processing],
            'dismissRole'       => [UserStatusEnum::Processing, UserStatusEnum::Active],
            'addIdentity'       => [UserStatusEnum::Created, UserStatusEnum::Processing, UserStatusEnum::Active],
            'removeIdentity'    => [UserStatusEnum::Created, UserStatusEnum::Processing, UserStatusEnum::Active]
        ]
    ];

    public static function canActivateUser(UserEntity $user): bool 
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['activate'],
            true
        );
    }

    public static function canArchiveUser(UserEntity $user): bool 
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['archive'],
            true
        );
    }

    public static function canAssignUserRole(UserEntity $user): bool   
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['assignRole'],
            true
        );
    }

    public static function canDismissUserRole(UserEntity $user): bool 
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['dismissRole'],
            true
        );
    }

    public static function canAddUserName(UserEntity $user): bool 
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['addName'],
            true
        );
    }

    public static function canSetPrimaryUserName(UserEntity $user): bool 
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['setPrimaryName'],
            true
        );
    }

    public static function canRemoveUserName(UserEntity $user): bool 
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['removeName'],
            true
        );
    }

    public static function canAddUserIdentity(UserEntity $user): bool 
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['addIdentity'] ,
            true
        );
    }

    public static function canRemoveUserIdentity(UserEntity $user): bool 
    {
        return in_array(
            $user->status,
            self::OPERATIONS['user']['removeIdentity'],
            true
        );
    }
    
    // Rack 
    public static function canPopulateRack(RackEntity $rack): bool 
    {
        return in_array(
            $rack->status,
            self::OPERATIONS['rack']['populate'],
            true
        );
    }

    public static function canActivateRack(RackEntity $rack): bool 
    {
        return in_array(
            $rack->status,
            self::OPERATIONS['rack']['activate'],
            true
        );
    }

    public static function canArchiveRack(RackEntity $rack): bool 
    {
        return in_array(
            $rack->status,
            self::OPERATIONS['rack']['archive'],
            true
        );
    }

    public static function canAddRackName(RackEntity $rack): bool 
    {
        return in_array(
            $rack->status,
            self::OPERATIONS['rack']['addName'],
            true
        );
    }

    public static function canSetPrimaryRackName(RackEntity $rack): bool 
    {
        return in_array(
            $rack->status,
            self::OPERATIONS['rack']['setPrimaryName'],
            true
        );
    }

    public static function canRemoveRackName(RackEntity $rack): bool 
    {
        return in_array(
            $rack->status,
            self::OPERATIONS['rack']['removeName '],
            true
        );
    }

    // Zone
    public static function canActivateZone(ZoneEntity $zone): bool 
    {
        return in_array(
            $zone->status,
            self::OPERATIONS['zone']['activate'],
            true
        );
    }

    public static function canMarkZoneAsCrowded(ZoneEntity $zone): bool
    {
        return in_array(
            $zone->status,
            self::OPERATIONS['zone']['markAsCrowded'],
            true
        );
    }

    public static function canArchiveZone(ZoneEntity $zone): bool
    {
        return in_array(
            $zone->status,
            self::OPERATIONS['zone']['archive'],
            true
        );
    }

    public static function canAddZoneName(ZoneEntity $zone): bool
    {
        return in_array(
            $zone->status,
            self::OPERATIONS['zone']['addName'],
            true
        );
    }

    public static function canSetPrimaryZoneName(ZoneEntity $zone): bool
    {
        return in_array(
            $zone->status,
            self::OPERATIONS['zone']['setPrimaryName'],
            true
        );
    }


    public static function canRemoveZoneName(ZoneEntity $zone): bool
    {
        return in_array(
            $zone->status,
            self::OPERATIONS['zone']['removeName'],
            true
        );
    }


    //Area 
    public static function canActivateArea(AreaEntity $area): bool
    {
        return in_array(
            $area->status,
            self::OPERATIONS['area']['activate'],
            true
        );
    }

    public static function canMarkAreaAsCrowded(AreaEntity $area): bool
    {
        return in_array(
            $area->status,
            self::OPERATIONS['area']['markAsCrowded'],
            true
        );
    }

    public static function canArchiveArea(AreaEntity $area): bool
    {
        return in_array(
            $area->status,
            self::OPERATIONS['area']['archive'],
            true
        );
    }

    public static function canAddAreaName(AreaEntity $area): bool
    {
        return in_array(
            $area->status,
            self::OPERATIONS['area']['addName'],
            true
        );
    }

    public static function canSetPrimaryAreaName(AreaEntity $area): bool
    {
        return in_array(
            $area->status,
            self::OPERATIONS['area']['setPrimaryName'],
            true
        );
    }

    public static function canRemoveAreaName(AreaEntity $area): bool
    {
        return in_array(
            $area->status,
            self::OPERATIONS['area']['removeName'],
            true
        );
    }

    public static function canGrantAreaAccess(AreaEntity $area): bool
    {
        return in_array(
            $area->status,
            self::OPERATIONS['area']['grantAccess'],
            true
        );
    }

    public static function canRevokeAreaAccess(AreaEntity $area): bool 
    {
        return in_array(
            $area->status,
            self::OPERATIONS['area']['revokeAccess'],
            true
        );
    }
}
