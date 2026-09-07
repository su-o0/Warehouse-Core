<?php

namespace WarehouseCore\Security;

use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Enum\RoleNameEnum;
use WarehouseCore\Payload\DTO\SessionDTO;

final readonly class Authorization
{
    private const OPERATIONS = [
        'get'   => [
            'area' => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'storageSlot' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'item' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman],
            'container' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'owner' => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'part' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman],
            'physicalTag' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'rack' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'shelf' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'stock' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman],
            'storedFile' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman, RoleNameEnum::Salesman],
            'user' => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'zone' => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'role' => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'provider' => [RoleNameEnum::Root],
        ],
        'area'  => [
            'create'            => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'activate'          => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'markAsCrowded'     => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'archive'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'addName'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'setPrimaryName'    => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'removeName'        => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'grantAccess'       => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'revokeAccess'      => [RoleNameEnum::Root, RoleNameEnum::Admin]
        ]
    ];

    public function __construct(
        private RoleNameEnum $role,
        private UserEntity $user
    ) {}

    public function getRole(): RoleNameEnum
    {
        return $this->role;
    }

    public function getUserId(): int
    {
        return $this->user->id;
    }

    public static function fromSession(
        SessionDTO $session
    ): self {
        return new self(
            $session->role,
            $session->user
        );
    }


    public function canFindAreaName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canGetStorageSlot(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            true
        );
    }

    public function canRevokeAreaAccess(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['revokeAccess'],
            true
        );
    }

    public function canPlaceRackToArea(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canPlaceRackToZone(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canSetPrimaryRackName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canRemoveRackName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canListUserNames(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canAddRackName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canArchiveRack(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canMarkRackAsCrowded(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canActivateRack(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canPopulateRack(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }
    public function canRegisterRack(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canListUserIdentities(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canListUser(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canRemoveUserIdentity(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canAddUserIdentity(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canRemoveUserName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canSetPrimaryUserName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canAddUserName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canDismissUserRole(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canAssignUserRole(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canActivateUser(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canArchiveUser(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canListZoneNames(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }


    public function canListAreaNames(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canListZone(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            true
        );
    }

    public function canArchiveZone(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canMarkZoneAsCrowded(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canActivateZone(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canCreateZone(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canAddZoneName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canSetPrimaryZoneName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canRemoveZoneName(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canAddAreaName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['addName'],
            true
        );
    }

    public function canSetPrimaryAreaName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['setPrimaryName'],
            true
        );
    }

    public function canListArea(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canGrantAreaAccess(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['grantAccess'],
            true
        );
    }

    public function canRemoveAreaName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['removeName'],
            true
        );
    }

    public function canCreateArea(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['create'],
            true
        );
    }

    public function canActivateArea(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['activate'],
            true
        );
    }

    public function canMarkAreaAsCrowded(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['markAsCrowded'],
            true
        );
    }

    public function canArchiveArea(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['area']['archive'],
            true
        );
    }

    public function canGetArea(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            true
        );
    }

    public function canGetContainer(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['container'],
            true
        );
    }

    public function canGetItem(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['item'],
            true
        );
    }

    public function canGetOwner(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['owner'],
            true
        );
    }

    public function canGetPart(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['part'],
            true
        );
    }

    public function canGetPhysicalTag(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['physicalTag'],
            true
        );
    }

    public function canGetRack(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['rack'],
            true
        );
    }

    public function canGetShelf(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['shelf'],
            true
        );
    }

    public function canGetStock(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['stock'],
            true
        );
    }

    public function canGetStoredFile(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['storedFile'],
            true
        );
    }

    public function canGetUser(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['user'],
            true
        );
    }



    public function canGetZone(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['zone'],
            true
        );
    }

    public function canGetRole(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['role'],
            true
        );
    }

    public function canGetProvider(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['provider'],
            true
        );
    }

    public function canCreatePhysicalTag(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canCreateUser(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canCreateItem(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            true
        );
    }

    public function canArchiveItem(): bool
    {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin],
            true
        );
    }

    public function canDelete(): bool
    {
        return $this->role === RoleNameEnum::Root;
    }
}
