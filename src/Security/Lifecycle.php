<?php

namespace WarehouseCore\Security;

use WarehouseCore\Payload\Entity\AreaEntity;
use WarehouseCore\Payload\Enum\AreaStatusEnum;

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
        ]
    ];

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
