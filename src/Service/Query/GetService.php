<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\DTO\ContainerEntity;
use WarehouseCore\Payload\DTO\LocationEntity;
use WarehouseCore\Payload\DTO\OwnerEntity;
use WarehouseCore\Payload\DTO\PhysicalTagEntity;
use WarehouseCore\Payload\DTO\RoleEntity;
use WarehouseCore\Payload\DTO\UserEntity;
use WarehouseCore\Payload\DTO\VehicleEntity;
use WarehouseCore\Payload\Value\ContainerPlacementValue;
use WarehouseCore\Payload\Value\ItemPlacementValue;
use WarehouseCore\Payload\Value\StockPlacementValue;
use WarehouseCore\Repository\Catalog\VehicleRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Security\Authorization;

final class GetService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ContainerPlacementRepository $container_placement,
        private ItemPlacementRepository $item_placement,
        private StockPlacementRepository $stock_placement,
        private PhysicalTagRepository $physical_tag,
        private ContainerRepository $container,
        private UserRepository $user,
        private OwnerRepository $owner,
        private VehicleRepository $vehicle,
        private RoleRepository $role,
        private LocationRepository $location
    ) { }
    public function getContainerPlacement(
        int $id
    ): ContainerPlacementValue {
        $container_placement = $this->container_placement->getById($id);
        
        if($container_placement === null) {
            throw DomainException::CONTAINER_PLACEMENT_NOT_FOUND();
        }

        return $container_placement;
    }

    public function getItemPlacement(
        int $id
    ): ItemPlacementValue {
        $item_placement = $this->item_placement->getById($id);
        
        if($item_placement === null) {
            throw DomainException::ITEM_PLACEMENT_NOT_FOUND();
        }

        return $item_placement;
    }

    public function getStockPlacement(
        int $id
    ): StockPlacementValue {
        $stock_placement = $this->stock_placement->getById($id);
        
        if($stock_placement === null) {
            throw DomainException::STOCK_PLACEMENT_NOT_FOUND();
        }

        return $stock_placement;
    }

    public function getLocation(
        int $id
    ): LocationEntity {
        $location = $this->location->getById($id);
        
        if($location === null) {
            throw DomainException::LOCATION_NOT_FOUND();
        }

        return $location;
    }

    public function getAllLocation(): array {
        $location = $this->location->getAll();

        return $location;
    }


    public function getPhysicalTag(
        int $physical_tag
    ): PhysicalTagEntity {
        $physical_tag = $this->physical_tag->getById($physical_tag);
        
        if($physical_tag === null) {
            throw DomainException::PHYSICAL_TAG_NOT_FOUND();
        }

        return $physical_tag;
    }

    public function getContainer(
        int $container_id
    ): ContainerEntity {
        $container = $this->container->getById($container_id);
        
        if($container === null) {
            throw DomainException::CONTAINER_NOT_FOUND();
        }

        return $container;
    }

    public function getUser(
        int $user_id
    ): UserEntity {
        $user = $this->user->getById($user_id);
        
        if($user === null) {
            throw DomainException::USER_NOT_FOUND();
        }

        return $user;
    }

    public function getOwner(
        int $id
    ): OwnerEntity {
        $owner = $this->owner->getById($id);

        if ($owner === null) {
            throw DomainException::OWNER_NOT_FOUND();
        }

        return $owner;
    }
    public function getVehicle(
        int $id
    ): VehicleEntity {
        $vehicle = $this->vehicle->getById($id);

        if ($vehicle === null) {
            throw DomainException::VEHICLE_NOT_FOUND();
        }

        return $vehicle;
    }
    public function getRole(
        int $id
    ): RoleEntity {
        $role = $this->role->getById($id);

        if ($role === null) {
            throw DomainException::ROLE_NOT_FOUND();
        }

        return $role;
    }
}