<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Entity\AreaEntity;
use WarehouseCore\Payload\Entity\ContainerEntity;
use WarehouseCore\Payload\Entity\ItemEntity;
use WarehouseCore\Payload\Entity\OwnerEntity;
use WarehouseCore\Payload\Entity\PartEntity;
use WarehouseCore\Payload\Entity\PhysicalTagEntity;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Entity\ShelfEntity;
use WarehouseCore\Payload\Entity\StockEntity;
use WarehouseCore\Payload\Entity\StoredFileEntity;
use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Entity\UserIdentityEntity;
use WarehouseCore\Payload\Entity\ZoneEntity;
use WarehouseCore\Payload\Reference\ProviderReference;
use WarehouseCore\Payload\Reference\RoleReference;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\ProviderRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\PhysicalTagRepository;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Inventory\ShelfRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Media\StoredFileRepository;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Repository\Topology\ZoneRepository;
use WarehouseCore\Security\Authorization;

final class GetService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private AreaRepository $area,
        private ContainerRepository $container,
        private ItemRepository $item,
        private OwnerRepository $owner,
        private PartRepository $part,
        private PhysicalTagRepository $physical_tag,
        private RackRepository $rack,
        private ShelfRepository $shelf,
        private StockRepository $stock,
        private StoredFileRepository $stored_file,
        private UserRepository $user,
        private UserIdentityRepository $user_identity,
        private ZoneRepository $zone,
        private RoleRepository $role,
        private ProviderRepository $provider

    ) { }

    public function getArea(
        int $area_id
    ): AreaEntity {
        if (!$this->authorization->canGetArea()) {
            throw ServiceException::FORBIDDEN();
        }

        $area = $this->area->getById($area_id);

        if ($area === null) {
            throw DomainException::AREA_NOT_FOUND();
        }

        return $area;
    }

    public function getContainer(
        int $container_id
    ): ContainerEntity {
        if (!$this->authorization->canGetContainer()) {
            throw ServiceException::FORBIDDEN();
        }

        $container = $this->container->getById($container_id);

        if ($container === null) {
            throw DomainException::CONTAINER_NOT_FOUND();
        }

        return $container;
    }

    public function getItem(
        int $item_id
    ): ItemEntity {
        if (!$this->authorization->canGetItem()) {
            throw ServiceException::FORBIDDEN();
        }
        
        $item = $this->item->getById($item_id);

        if ($item === null) {
            throw DomainException::ITEM_NOT_FOUND();
        }

        return $item;
    }

    public function getOwner(
        int $owner_id
    ): OwnerEntity {
        if (!$this->authorization->canGetOwner()) {
            throw ServiceException::FORBIDDEN();
        }

        $owner = $this->owner->getById($owner_id);

        if ($owner === null) {
            throw DomainException::OWNER_NOT_FOUND();
        }

        return $owner;
    }

    public function getPart(
        int $part_id
    ): PartEntity {
        if (!$this->authorization->canGetPart()) {
            throw ServiceException::FORBIDDEN();
        }

        $part = $this->part->getById($part_id);

        if ($part === null) {
            throw DomainException::PART_NOT_FOUND();
        }

        return $part;
    }

    public function getPhysicalTag(
        int $physical_tag_id
    ): PhysicalTagEntity {
        if (!$this->authorization->canGetPhysicalTag()) {
            throw ServiceException::FORBIDDEN();
        }

        $physical_tag = $this->physical_tag->getById($physical_tag_id);

        if ($physical_tag === null) {
            throw DomainException::PHYSICAL_TAG_NOT_FOUND();
        }

        return $physical_tag;
    }

    public function getRack(
        int $rack_id
    ): RackEntity {
        if (!$this->authorization->canGetRack()) {
            throw ServiceException::FORBIDDEN();
        }

        $rack = $this->rack->getById($rack_id);

        if ($rack === null) {
            throw DomainException::RACK_NOT_FOUND();
        }

        return $rack;
    }

    public function getShelf(
        int $shelf_id
    ): ShelfEntity {
        if (!$this->authorization->canGetShelf()) {
            throw ServiceException::FORBIDDEN();
        }

        $shelf = $this->shelf->getById($shelf_id);

        if ($shelf === null) {
            throw DomainException::SHELF_NOT_FOUND();
        }

        return $shelf;
    }

    public function getStock(
        int $stock_id
    ): StockEntity {
        if (!$this->authorization->canGetStock()) {
            throw ServiceException::FORBIDDEN();
        }

        $stock = $this->stock->getById($stock_id);

        if ($stock === null) {
            throw DomainException::STOCK_NOT_FOUND();
        }

        return $stock;
    }

    public function getStoredFile(
        int $stored_file_id
    ): StoredFileEntity {
        if (!$this->authorization->canGetStoredFile()) {
            throw ServiceException::FORBIDDEN();
        }

        $stored_file = $this->stored_file->getById($stored_file_id);

        if ($stored_file === null) {
            throw DomainException::STORED_FILE_NOT_FOUND();
        }

        return $stored_file;
    }

    public function getUser(
        int $user_id
    ): UserEntity {
        if (!$this->authorization->canGetUser()) {
            throw ServiceException::FORBIDDEN();
        }

        $user = $this->user->getById($user_id);

        if ($user === null) {
            throw DomainException::USER_NOT_FOUND();
        }

        return $user;
    }

    public function getUserIdentity(
        int $user_identity_id
    ): UserIdentityEntity {
        if (!$this->authorization->canGetUserIdentity()) {
            throw ServiceException::FORBIDDEN();
        }

        $user_identity = $this->user_identity->getById($user_identity_id);

        if ($user_identity === null) {
            throw DomainException::USER_IDENTITY_NOT_FOUND();
        }

        return $user_identity;
    }

    public function getZone(
        int $zone_id
    ): ZoneEntity {
        if (!$this->authorization->canGetZone()) {
            throw ServiceException::FORBIDDEN();
        }

        $zone = $this->zone->getById($zone_id);

        if ($zone === null) {
            throw DomainException::ZONE_NOT_FOUND();
        }

        return $zone;
    }

    public function getRole(
        string $name
    ): RoleReference {
        if (!$this->authorization->canGetRole()) {
            throw ServiceException::FORBIDDEN();
        }

        $role = $this->role->getByName($name);

        if ($role === null) {
            throw DomainException::ROLE_NOT_FOUND();
        }

        return $role;
    }

    public function getProvider(
        string $name
    ): ProviderReference {
        if (!$this->authorization->canGetProvider()) {
            throw ServiceException::FORBIDDEN();
        }

        $provider = $this->provider->getByName($name);

        if ($provider === null) {
            throw DomainException::PROVIDER_NOT_FOUND();
        }

        return $provider;
    }
}