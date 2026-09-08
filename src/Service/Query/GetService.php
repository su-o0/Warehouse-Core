<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\ProviderRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\PhysicalTagRepository;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Topology\ShelfRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Media\StoredFileRepository;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Repository\Topology\StorageSlotRepository;
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
        private StorageSlotRepository $storage_slot,
        private StockRepository $stock,
        private StoredFileRepository $stored_file,
        private UserRepository $user,
        private ZoneRepository $zone,
        private RoleRepository $role,
        private ProviderRepository $provider

    ) { }

    public function getArea(
        int $area_id
    ): ServiceResult {
        if (!$this->authorization->canGetArea()) {
            throw ServiceException::FORBIDDEN();
        }

        $area = $this->area->getById($area_id);

        if ($area === null) {
            return ServiceResult::failure(ErrorMessage::AREA_NOT_FOUND);
        }

        return ServiceResult::entity($area);
    }

    public function getContainer(
        int $container_id
    ): ServiceResult {
        if (!$this->authorization->canGetContainer()) {
            throw ServiceException::FORBIDDEN();
        }

        $container = $this->container->getById($container_id);

        if ($container === null) {
            return ServiceResult::failure(ErrorMessage::CONTAINER_NOT_FOUND);
        }

        return ServiceResult::entity($container);
    }

    public function getItem(
        int $item_id
    ): ServiceResult {
        if (!$this->authorization->canGetItem()) {
            throw ServiceException::FORBIDDEN();
        }
        
        $item = $this->item->getById($item_id);

        if ($item === null) {
            return ServiceResult::failure(ErrorMessage::ITEM_NOT_FOUND);
        }

        return ServiceResult::entity($item);
    }

    public function getOwner(
        int $owner_id
    ): ServiceResult {
        if (!$this->authorization->canGetOwner()) {
            throw ServiceException::FORBIDDEN();
        }

        $owner = $this->owner->getById($owner_id);

        if ($owner === null) {
            return ServiceResult::failure(ErrorMessage::OWNER_NOT_FOUND);
        }

        return ServiceResult::entity($owner);
    }

    public function getPart(
        int $part_id
    ): ServiceResult {
        if (!$this->authorization->canGetPart()) {
            throw ServiceException::FORBIDDEN();
        }

        $part = $this->part->getById($part_id);

        if ($part === null) {
            return ServiceResult::failure(ErrorMessage::PART_NOT_FOUND);
        }

        return ServiceResult::entity($part);
    }

    public function getPhysicalTag(
        int $physical_tag_id
    ): ServiceResult {
        if (!$this->authorization->canGetPhysicalTag()) {
            throw ServiceException::FORBIDDEN();
        }

        $physical_tag = $this->physical_tag->getById($physical_tag_id);

        if ($physical_tag === null) {
            return ServiceResult::failure(ErrorMessage::PHYSICAL_TAG_NOT_FOUND);
        }

        return ServiceResult::entity($physical_tag);
    }

    public function getRack(
        int $rack_id
    ): ServiceResult {
        if (!$this->authorization->canGetRack()) {
            throw ServiceException::FORBIDDEN();
        }

        $rack = $this->rack->getById($rack_id);

        if ($rack === null) {
            return ServiceResult::failure(ErrorMessage::RACK_NOT_FOUND);
        }

        return ServiceResult::entity($rack);
    }

    public function getShelf(
        int $shelf_id
    ): ServiceResult {
        if (!$this->authorization->canGetShelf()) {
            throw ServiceException::FORBIDDEN();
        }

        $shelf = $this->shelf->getById($shelf_id);

        if ($shelf === null) {
            return ServiceResult::failure(ErrorMessage::SHELF_NOT_FOUND);
        }

        return ServiceResult::entity($shelf);
    }

    public function getStorageSlot(
        int $storage_slot_id
    ): ServiceResult {
        if (!$this->authorization->canGetShelf()) {
            throw ServiceException::FORBIDDEN();
        }

        $storage_slot = $this->storage_slot->getById($storage_slot_id);

        if ($storage_slot === null) {
            return ServiceResult::failure(ErrorMessage::SHELF_NOT_FOUND);
        }

        return ServiceResult::entity($storage_slot);
    }

    public function getStock(
        int $stock_id
    ): ServiceResult {
        if (!$this->authorization->canGetStock()) {
            throw ServiceException::FORBIDDEN();
        }

        $stock = $this->stock->getById($stock_id);

        if ($stock === null) {
            return ServiceResult::failure(ErrorMessage::STOCK_NOT_FOUND);
        }

        return ServiceResult::entity($stock);
    }

    public function getStoredFile(
        int $stored_file_id
    ): ServiceResult {
        if (!$this->authorization->canGetStoredFile()) {
            throw ServiceException::FORBIDDEN();
        }

        $stored_file = $this->stored_file->getById($stored_file_id);

        if ($stored_file === null) {
            return ServiceResult::failure(ErrorMessage::STORED_FILE_NOT_FOUND);
        }

        return ServiceResult::entity($stored_file);
    }

    public function getUser(
        int $user_id
    ): ServiceResult {
        if (!$this->authorization->canGetUser()) {
            throw ServiceException::FORBIDDEN();
        }

        $user = $this->user->getById($user_id);

        if ($user === null) {
            return ServiceResult::failure(
                ErrorMessage::USER_NOT_FOUND
            );
        }

        return ServiceResult::entity($user);
    }

    public function getZone(
        int $zone_id
    ): ServiceResult {
        if (!$this->authorization->canGetZone()) {
            throw ServiceException::FORBIDDEN();
        }

        $zone = $this->zone->getById($zone_id);

        if ($zone === null) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_NOT_FOUND
            );
        }

        return ServiceResult::entity($zone);
    }

    public function getRole(
        string $name
    ): ServiceResult {
        if (!$this->authorization->canGetRole()) {
            throw ServiceException::FORBIDDEN();
        }

        $role = $this->role->getByName($name);

        if ($role === null) {
            return ServiceResult::failure(ErrorMessage::ROLE_NOT_FOUND);
        }

        return ServiceResult::entity($role);
    }

    public function getProvider(
        string $name
    ): ServiceResult {
        if (!$this->authorization->canGetProvider()) {
            throw ServiceException::FORBIDDEN();
        }

        $provider = $this->provider->getByName($name);

        if ($provider === null) {
            return ServiceResult::failure(ErrorMessage::PROVIDER_NOT_FOUND);
        }

        return ServiceResult::entity($provider);
    }
}