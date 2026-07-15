<?php 
namespace WarehouseCore\Security;

use WarehouseCore\Payload\DTO\Session;
use WarehouseCore\Payload\Type\RoleName;

final class Authorization {
    public function __construct(
        private RoleName $role
    ) { }

    public static function fromSession(
        Session $session
    ) : self {
        return new self(
            $session->role->name
        );
    }

    public function canFindArticle(): bool {
        return in_array(
            $this->role,
            [RoleName::Root, RoleName::Admin, RoleName::Worker, RoleName::Salesman]
        );
    }

    public function canFindUser(): bool {
        return in_array(
            $this->role,
            [RoleName::Root, RoleName::Admin]
        );
    }

    public function canCreateUser(): bool {
        return in_array(
            $this->role,
            [RoleName::Root, RoleName::Admin]
        );
    }

    public function canCreateUserIdentity(): bool {
        return in_array(
            $this->role,
            [RoleName::Root, RoleName::Admin]
        );
    }

    public function canCreateItem(): bool {
        return in_array(
            $this->role,
            [RoleName::Root, RoleName::Admin, RoleName::Worker]
        );
    }

    public function canArchiveItem(): bool {
        return in_array(
            $this->role,
            [RoleName::Root, RoleName::Admin]
        );
    }

    public function canDelete( ): bool {
        return $this->role === RoleName::Root;
    }
}