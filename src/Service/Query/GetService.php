<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\DTO\RoleEntity;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Security\Authorization;

final class GetService {
    public function __construct(
        public string $service_name,
        private RoleRepository $role_repository,
        private LocationRepository $location_repository
    ) { }

    public function getRole(
        int $role_id
    ): RoleEntity {
        $role = $this->role_repository->getById($role_id);

        if ($role === null) {
            throw DomainException::ROLE_NOT_FOUND();
        }

        return $role;
    }
}