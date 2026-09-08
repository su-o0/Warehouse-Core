<?php

namespace WarehouseCore\Security;

use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Enum\RoleNameEnum;
use WarehouseCore\Payload\DTO\SessionDTO;

final readonly class Authorization
{
    private const OPERATIONS = [
        'list'      => [
            'area'              => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'user'              => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'userIdentities'    => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'zoneByArea'        => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'areaNames'         => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'zoneNames'         => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'userNames'         => [RoleNameEnum::Root, RoleNameEnum::Admin],

        ],
        'find'      => [
            'areaName'          => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'zoneName'          => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'rackName'          => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
        ],
        'get'       => [
            'area'              => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'storageSlot'       => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'item'              => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman],
            'container'         => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'owner'             => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'part'              => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman],
            'physicalTag'       => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'rack'              => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'shelf'             => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'stock'             => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman],
            'storedFile'        => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman, RoleNameEnum::Salesman],
            'user'              => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'zone'              => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'role'              => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'provider'          => [RoleNameEnum::Root],
        ],
        'area'      => [
            'create'            => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'activate'          => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'markAsCrowded'     => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'archive'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'addName'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'setPrimaryName'    => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'removeName'        => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'grantAccess'       => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'revokeAccess'      => [RoleNameEnum::Root, RoleNameEnum::Admin]
        ],
        'user'      => [
            'create'            => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'activate'          => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'archive'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'addName'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'setPrimaryName'    => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'removeName'        => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'assignRole'        => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'dismissRole'       => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'addIdentity'       => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'removeIdentity'    => [RoleNameEnum::Root, RoleNameEnum::Admin]
        ],
        'zone'      => [
            'create'            => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'activate'          => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'markAsCrowded'     => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'archive'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'addName'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'setPrimaryName'    => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'removeName'        => [RoleNameEnum::Root, RoleNameEnum::Admin],
        ],
        'rack'      => [
            'register'          => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'populate'          => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'activate'          => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'markAsCrowded'     => [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker],
            'archive'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'addName'           => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'setPrimaryName'    => [RoleNameEnum::Root, RoleNameEnum::Admin],
            'removeName'        => [RoleNameEnum::Root, RoleNameEnum::Admin],
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

    // Find
    public function canFindAreaName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['find']['areaName'],
            true
        );
    }

    public function canFindZoneName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['find']['zoneName'],
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
            self::OPERATIONS['rack']['setPrimaryName'],
            true
        );
    }

    public function canRemoveRackName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['rack']['removeName'],
            true
        );
    }

    // List
    public function canListArea(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['list']['area'],
            true
        );
    }

    public function canListZoneByArea(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['list']['zoneByArea'],
            true
        );
    }

    public function canListAreaNames(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['list']['areaNames'],
            true
        );
    }

    public function canListUserIdentities(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['list']['userIdentities'],
            true
        );
    }

    public function canListUser(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['list']['user'],
            true
        );
    }

    public function canListZoneNames(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['list']['zoneNames'],
            true
        );
    }

    public function canListUserNames(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['list']['userNames'],
            true
        );
    }

    public function canAddRackName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['rack']['addName'],
            true
        );
    }

    public function canArchiveRack(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['rack']['activate'],
            true
        );
    }

    public function canMarkRackAsCrowded(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['rack']['markAsCrowded'],
            true
        );
    }

    public function canActivateRack(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['rack']['archive'],
            true
        );
    }

    public function canPopulateRack(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['rack']['populate'],
            true
        );
    }
    public function canRegisterRack(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['rack']['register'],
            true
        );
    }

    // User

    public function canCreateUser(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['create'],
            true
        );
    }
    
    public function canActivateUser(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['activate'],
            true
        );
    }

    public function canArchiveUser(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['archive'],
            true
        );
    }

    public function canAddUserName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['addName'],
            true
        );
    }

    public function canSetPrimaryUserName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['setPrimaryName'],
            true
        );
    }

    public function canRemoveUserName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['removeName'],
            true
        );
    }

    public function canAssignUserRole(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['assignRole'],
            true
        );
    }

    public function canDismissUserRole(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['dismissRole'],
            true
        );
    }

    public function canAddUserIdentity(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['addIdentity'],
            true
        );
    }
    
    public function canRemoveUserIdentity(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['user']['removeIdentity'],
            true
        );
    }

    // Zone
    public function canCreateZone(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['zone']['create'],
            true
        );
    }


    public function canArchiveZone(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['zone']['archive'],
            true
        );
    }

    public function canMarkZoneAsCrowded(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['zone']['markAsCrowded'],
            true
        );
    }

    public function canActivateZone(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['zone']['activate'],
            true
        );
    }

    public function canAddZoneName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['zone']['addName'],
            true
        );
    }

    public function canSetPrimaryZoneName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['zone']['setPrimaryName'],
            true
        );
    }

    public function canRemoveZoneName(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['zone']['removeName'],
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

    // Get

    public function canGetArea(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['area'],
            true
        );
    }

    public function canGetStorageSlot(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['storageSlot'],
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

    public function canGetContainer(): bool
    {
        return in_array(
            $this->role,
            self::OPERATIONS['get']['container'],
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