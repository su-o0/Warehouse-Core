<?php 
namespace WarehouseCore\Security;

use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Enum\RoleNameEnum;
use WarehouseCore\Payload\DTO\SessionDTO;

final readonly class Authorization {
    public function __construct(
        private RoleNameEnum $role,
        public UserEntity $user
    ) { }

    public static function fromSession(
        SessionDTO $session
    ) : self {  
        return new self(
            $session->role,
            $session->user
        );
    }
    
    public function canRevokeAreaAccess(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }
    
    public function canSetPrimaryRackName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canRemoveRackName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canListUserNames(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }
    
    public function canAddRackName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canArchiveRack(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canMarkRackAsCrowded(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canActivateRack(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canCreateRack(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canListUserIdentities(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canListUser(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canRemoveUserIdentity(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canAddUserIdentity(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }
    
    public function canRemoveUserName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }
    
    public function canSetPrimaryUserName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canAddUserName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canDismissUserRole(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canAssignUserRole(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canActivateUser(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canArchiveUser(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }
    
    public function canListZoneNames(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }


    public function canListAreaNames(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canListZone(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }

    public function canArchiveZone(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canMarkZoneAsCrowded(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canActivateZone(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canCreateZone(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canAddZoneName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canSetPrimaryZoneName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canRemoveZoneName(): bool{
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canAddAreaName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canSetPrimaryAreaName(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canListArea(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canGrantAreaAccess(): bool{
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canRemoveAreaName(): bool{
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canCreateArea(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }
    
    public function canActivateArea(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canMarkAreaAsCrowded(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }
        
    public function canArchiveArea(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canGetArea(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }

    public function canGetContainer(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }

    public function canGetItem(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman]
        );
    }

    public function canGetOwner(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canGetPart(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman]
        );
    }

    public function canGetPhysicalTag(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker, RoleNameEnum::Salesman]
        );
    }

    public function canGetRack(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }
    
    public function canGetShelf(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }
    
    public function canGetStock(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }
    
    public function canGetStoredFile(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }
    
    public function canGetUser(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canGetUserIdentity(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canGetZone(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }

    public function canGetRole(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root]
        );
    }

    public function canGetProvider(): bool {
       return in_array(
            $this->role,
            [RoleNameEnum::Root]
        );
    }
    
    public function canCreatePhysicalTag(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canCreateUser(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canCreateItem(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin, RoleNameEnum::Worker]
        );
    }

    public function canArchiveItem(): bool {
        return in_array(
            $this->role,
            [RoleNameEnum::Root, RoleNameEnum::Admin]
        );
    }

    public function canDelete( ): bool {
        return $this->role === RoleNameEnum::Root;
    }
}