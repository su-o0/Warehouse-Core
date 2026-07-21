<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\DTO\ContainerEntity;
use WarehouseCore\Payload\DTO\OwnerEntity;
use WarehouseCore\Payload\DTO\PhysicalTagEntity;
use WarehouseCore\Payload\DTO\RoleEntity;
use WarehouseCore\Payload\DTO\UserEntity;
use WarehouseCore\Payload\DTO\VehicleEntity;
use WarehouseCore\Repository\Catalog\VehicleRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Topology\LocationRepository;

final class GetService {
    public function __construct(
        public string $service_name,
        private PhysicalTagRepository $physical_tag_repository,
        private ContainerRepository $container_repository,
        private UserRepository $user_repository,
        private OwnerRepository $owner_repository,
        private VehicleRepository $vehicle_repository,
        private RoleRepository $role_repository,
        private LocationRepository $location_repository
    ) { }

    public function getPhysicalTag(
        int $physical_tag
    ): PhysicalTagEntity {
        $physical_tag = $this->physical_tag_repository->getById($physical_tag);
        
        if($physical_tag === null) {
            throw DomainException::PHYSICAL_TAG_NOT_FOUND();
        }

        return $physical_tag;
    }

    public function getContainer(
        int $container_id
    ): ContainerEntity {
        $container = $this->container_repository->getById($container_id);
        
        if($container === null) {
            throw DomainException::CONTAINER_NOT_FOUND();
        }

        return $container;
    }

    public function getUser(
        int $user_id
    ): UserEntity {
        $user = $this->user_repository->getById($user_id);
        
        if($user === null) {
            throw DomainException::USER_NOT_FOUND();
        }

        return $user;
    }

    public function getOwner(
        int $id
    ): OwnerEntity {
        $owner = $this->owner_repository->getById($id);

        if ($owner === null) {
            throw DomainException::OWNER_NOT_FOUND();
        }

        return $owner;
    }
    public function getVehicle(
        int $id
    ): VehicleEntity {
        $vehicle = $this->vehicle_repository->getById($id);

        if ($vehicle === null) {
            throw DomainException::VEHICLE_NOT_FOUND();
        }

        return $vehicle;
    }
    public function getRole(
        int $id
    ): RoleEntity {
        $role = $this->role_repository->getById($id);

        if ($role === null) {
            throw DomainException::ROLE_NOT_FOUND();
        }

        return $role;
    }
}