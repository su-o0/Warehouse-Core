<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Api\Area\Command\ActivateAreaApi;
use WarehouseCore\Api\Area\Command\AddAreaNameApi;
use WarehouseCore\Api\Area\Command\ArchiveAreaApi;
use WarehouseCore\Api\Area\Command\CreateAreaApi;
use WarehouseCore\Api\Area\Command\GrantAreaAccessApi;
use WarehouseCore\Api\Area\Command\MarkAreaAsCrowdedApi;
use WarehouseCore\Api\Area\Command\RemoveAreaNameApi;
use WarehouseCore\Api\Area\Command\RevokeAreaAccessApi;
use WarehouseCore\Api\Area\Command\SetPrimaryAreaNameApi;
use WarehouseCore\Api\Area\Query\ListAreaApi;
use WarehouseCore\Api\Area\Query\ListAreaNamesApi;
use WarehouseCore\Api\Zone\Command\PlaceZoneToAreaApi;
use WarehouseCore\Api\Catalog\Zone\SetPrimaryZoneNameApi;
use WarehouseCore\Api\Rack\Command\ActivateRackApi;
use WarehouseCore\Api\Rack\Command\AddRackNameApi;
use WarehouseCore\Api\Rack\Command\ArchiveRackApi;
use WarehouseCore\Api\Rack\Command\PopulateRackApi;
use WarehouseCore\Api\Rack\Command\RegisterRackApi;
use WarehouseCore\Api\Rack\Command\RemoveRackNameApi;
use WarehouseCore\Api\Rack\Command\SetPrimaryRackNameApi;
use WarehouseCore\Api\Shelf\Command\MarkShelfAsCrowdedApi;
use WarehouseCore\Api\Shelf\Command\RegisterShelfApi;
use WarehouseCore\Api\Shelf\Command\RemoveShelfApi;
use WarehouseCore\Api\StorageSlot\Command\MarkStorageSlotAsCrowdedApi;
use WarehouseCore\Api\StorageSlot\Command\RegisterStorageSlotApi;
use WarehouseCore\Api\StorageSlot\Command\RemoveStorageSlotApi;
use WarehouseCore\Api\User\Command\ActivateUserApi;
use WarehouseCore\Api\User\Command\AddUserIdentityApi;
use WarehouseCore\Api\User\Command\AddUserNameApi;
use WarehouseCore\Api\User\Command\ArchiveUserApi;
use WarehouseCore\Api\User\Command\AssignUserRoleApi;
use WarehouseCore\Api\User\Command\CreateUserApi;
use WarehouseCore\Api\User\Command\DismissUserRoleApi;
use WarehouseCore\Api\User\Command\ListUserNamesApi;
use WarehouseCore\Api\User\Command\RemoveUserIdentityApi;
use WarehouseCore\Api\User\Command\RemoveUserNameApi;
use WarehouseCore\Api\User\Command\SetPrimaryUserNameApi;
use WarehouseCore\Api\User\Query\ListUserApi;
use WarehouseCore\Api\User\Query\ListUserIdentitiesApi;
use WarehouseCore\Config\ApiConfig;
use WarehouseCore\Context\ServiceContext;
use WarehouseCore\Api\Zone\Command\ActivateZoneApi;
use WarehouseCore\Api\Zone\Command\AddZoneNameApi;
use WarehouseCore\Api\Zone\Command\ArchiveZoneApi;
use WarehouseCore\Api\Zone\Command\CreateZoneApi;
use WarehouseCore\Api\Zone\Command\MarkZoneAsCrowdedApi;
use WarehouseCore\Api\Zone\Command\RemoveZoneNameApi;
use WarehouseCore\Api\Zone\Query\ListZoneApi;
use WarehouseCore\Api\Zone\Query\ListZoneByAreaApi;
use WarehouseCore\Api\Zone\Query\ListZoneNamesApi;

final class ApiRegistry {
    // private ?ActivatePartApi $activate_part = null;
    // private ?AddPartNameApi $add_part_name = null;
    // private ?AddPartNumberApi $add_part_number = null;
    // private ?ArchivePartApi $archive_part = null;
    // private ?CreatePartApi $create_part = null;
    // private ?ListPartNamesApi $list_part_names = null;
    // private ?ListPartNumbersApi $list_part_numbers = null;
    // private ?ListVehicleApi $list_vehicle = null;
    // private ?RegisterVehicleApi $register_vehicle = null;
    // private ?RemovePartNameApi $remove_part_name = null;
    // private ?RemovePartNumberApi $remove_part_number = null;
    // private ?SetPrimaryPartNameApi $set_primary_part_name = null;
    // private ?SetPrimaryPartNumberApi $set_primary_part_number = null;
    // private ?ActivateOwnerApi $activate_owner = null;
    // private ?ArchiveOwnerApi $archive_owner = null;
    // private ?CreateOwnerApi $create_owner = null;
    private ?GrantAreaAccessApi $grant_area_access = null;
    // private ?ListOwnerApi $list_owner = null;
    private ?RevokeAreaAccessApi $revoke_area_access = null;
    // private ?ActivateContainerApi $activate_container = null;
    // private ?ActivateItemApi $activate_item = null;
    // private ?ActivateStockApi $activate_stock = null;
    // private ?AdjustStockQtyApi $adjust_stock_qty = null;
    // private ?ArchiveContainerApi $archive_container = null;
    // private ?ArchiveItemApi $archive_item = null;
    // private ?ArchiveStockApi $archive_stock = null;
    // private ?AssignPhysicalTagApi $assign_physical_tag = null;
    // private ?CreateItemApi $create_item = null;
    // private ?CreateStockApi $create_stock = null;
    // private ?ListContainerApi $list_container = null;
    // private ?ListContainerByShelfApi $list_container_by_shelf = null;
    // private ?ListContainerByZoneApi $list_container_by_zone = null;
    // private ?ListItemApi $list_item = null;
    // private ?ListItemByOwnerApi $list_item_by_owner = null;
    // private ?ListPhysicalTagApi $list_physical_tag = null;
    // private ?ListStockApi $list_stock = null;
    // private ?MarkContainerAsCrowdedApi $mark_container_as_crowded = null;
    // private ?MarkContainerAsLostApi $mark_container_as_lost = null;
    // private ?MarkItemAsLostApi $mark_item_as_lost = null;
    // private ?MarkPhysicalTagAsBrokenApi $mark_physical_tag_as_broken = null;
    // private ?MarkPhysicalTagAsLostApi $mark_physical_tag_as_lost = null;
    // private ?MarkStockAsCrowdedApi $mark_stock_as_crowded = null;
    // private ?MarkStockAsLostApi $mark_stock_as_lost = null;
    // private ?RegisterContainerApi $register_container = null;
    // private ?RegisterPhysicalTagApi $register_physical_tag = null;
    // private ?ReleasePhysicalTagApi $release_physical_tag = null;
    // private ?SellItemApi $sell_item = null;
    // private ?SellStockApi $sell_stock = null;
    // private ?SetItemConditionApi $set_item_condition = null;
    // private ?AddContainerPhotoApi $add_container_photo = null;
    // private ?AddItemPhotoApi $add_item_photo = null;
    // private ?AddPartPhotoApi $add_part_photo = null;
    // private ?AddRackPhotoApi $add_rack_photo = null;
    // private ?AddStockPhotoApi $add_stock_photo = null;
    // private ?AddUserPhotoApi $add_user_photo = null;
    // private ?AddVehiclePhotoApi $add_vehicle_photo = null;
    // private ?ListContainerPhotosApi $list_container_photos = null;
    // private ?ListItemPhotosApi $list_item_photos = null;
    // private ?ListPartPhotosApi $list_part_photos = null;
    // private ?ListRackPhotosApi $list_rack_photos = null;
    // private ?ListStockPhotosApi $list_stock_photos = null;
    // private ?ListUserPhotosApi $list_user_photos = null;
    // private ?ListVehiclePhotosApi $list_vehicle_photos = null;
    // private ?RemoveContainerPhotoApi $remove_container_photo = null;
    // private ?RemoveItemPhotoApi $remove_item_photo = null;
    // private ?RemovePartPhotoApi $remove_part_photo = null;
    // private ?RemoveRackPhotoApi $remove_rack_photo = null;
    // private ?RemoveStockPhotoApi $remove_stock_photo = null;
    // private ?RemoveUserPhotoApi $remove_user_photo = null;
    // private ?RemoveVehiclePhotoApi $remove_vehicle_photo = null;
    // private ?AddItemVideoApi $add_item_video = null;
    // private ?AddPartVideoApi $add_part_video = null;
    // private ?AddStockVideoApi $add_stock_video = null;
    // private ?AddVehicleVideoApi $add_vehicle_video = null;
    // private ?ListItemVideosApi $list_item_videos = null;
    // private ?ListPartVideosApi $list_part_videos = null;
    // private ?ListStockVideosApi $list_stock_videos = null;
    // private ?ListVehicleVideosApi $list_vehicle_videos = null;
    // private ?RemoveItemVideoApi $remove_item_video = null;
    // private ?RemovePartVideoApi $remove_part_video = null;
    // private ?RemoveStockVideoApi $remove_stock_video = null;
    // private ?RemoveVehicleVideoApi $remove_vehicle_video = null;
    // private ?ListProviderApi $list_provider = null;
    // private ?ListRoleApi $list_role = null;
    private ?ActivateAreaApi $activate_area = null;
    private ?ActivateRackApi $activate_rack = null;
    private ?ActivateZoneApi $activate_zone = null;
    private ?AddAreaNameApi $add_area_name = null;
    private ?AddRackNameApi $add_rack_name = null;
    private ?AddZoneNameApi $add_zone_name = null;
    private ?ArchiveAreaApi $archive_area = null;
    private ?ArchiveRackApi $archive_rack = null;
    private ?ArchiveZoneApi $archive_zone = null;
    private ?CreateAreaApi $create_area = null;
    private ?CreateZoneApi $create_zone = null;
    private ?ListAreaApi $list_area = null;
    private ?ListAreaNamesApi $list_area_names = null;
    // private ?ListRackApi $list_rack = null;
    // private ?ListRackByAreaApi $list_rack_by_area = null;
    // private ?ListRackByZoneApi $list_rack_by_zone = null;
    // private ?ListRackNamesApi $list_rack_names = null;
    private ?ListZoneApi $list_zone = null;
    private ?ListZoneByAreaApi $list_zone_by_area = null;
    private ?ListZoneNamesApi $list_zone_names = null;
    private ?MarkAreaAsCrowdedApi $mark_area_as_crowded = null;
    private ?MarkZoneAsCrowdedApi $mark_zone_as_crowded = null;
    private ?PopulateRackApi $populate_rack = null;
    private ?RegisterRackApi $register_rack = null;
    private ?RegisterShelfApi $register_shelf = null;
    private ?RegisterStorageSlotApi $register_storage_slot = null;
    private ?RemoveAreaNameApi $remove_area_name = null;
    private ?RemoveRackNameApi $remove_rack_name = null;
    private ?RemoveShelfApi $remove_shelf = null;
    private ?RemoveStorageSlotApi $remove_storage_slot = null;
    private ?RemoveZoneNameApi $remove_zone_name = null;
    private ?SetPrimaryAreaNameApi $set_primary_area_name = null;
    private ?SetPrimaryRackNameApi $set_primary_rack_name = null;
    private ?SetPrimaryZoneNameApi $set_primary_zone_name = null;
    private ?MarkShelfAsCrowdedApi $mark_shelf_as_crowded = null;
    private ?MarkStorageSlotAsCrowdedApi $mark_storage_slot_as_crowded = null;
    // private ?MoveContainerToShelfApi $move_container_to_shelf = null;
    // private ?MoveContainerToZoneApi $move_container_to_zone = null;
    // private ?MoveItemToContainerApi $move_item_to_container = null;
    // private ?MoveItemToShelfApi $move_item_to_shelf = null;
    // private ?MoveItemToZoneApi $move_item_to_zone = null;
    // private ?MoveRackToAreaApi $move_rack_to_area = null;
    // private ?MoveRackToZoneApi $move_rack_to_zone = null;
    // private ?MoveStockToContainerApi $move_stock_to_container = null;
    // private ?MoveStockToShelfApi $move_stock_to_shelf = null;
    // private ?MoveStockToZoneApi $move_stock_to_zone = null;
    // private ?PlaceContainerToShelfApi $place_container_to_shelf = null;
    // private ?PlaceContainerToZoneApi $place_container_to_zone = null;
    // private ?PlaceItemToContainerApi $place_item_to_container = null;
    // private ?PlaceItemToShelfApi $place_item_to_shelf = null;
    // private ?PlaceItemToZoneApi $place_item_to_zone = null;
    // private ?PlaceRackToAreaApi $place_rack_to_area = null;
    // private ?PlaceRackToZoneApi $place_rack_to_zone = null;
    // private ?PlaceStockToContainerApi $place_stock_to_container = null;
    // private ?PlaceStockToShelfApi $place_stock_to_shelf = null;
    // private ?PlaceStockToZoneApi $place_stock_to_zone = null;
    private ?ActivateUserApi $activate_user = null;
    private ?AddUserIdentityApi $add_user_identity = null;
    private ?AddUserNameApi $add_user_name = null;
    private ?ArchiveUserApi $archive_user = null;
    private ?AssignUserRoleApi $assign_user_role = null;
    private ?CreateUserApi $create_user = null;
    private ?DismissUserRoleApi $dismiss_user_role = null;
    private ?ListUserApi $list_user = null;
    private ?ListUserIdentitiesApi $list_user_identities = null;
    private ?ListUserNamesApi $list_user_names = null;
    private ?RemoveUserIdentityApi $remove_user_identity = null;
    private ?RemoveUserNameApi $remove_user_name = null;
    private ?SetPrimaryUserNameApi $set_primary_user_name = null;

    public function __construct(
        private ApiConfig $config,
        private ServiceContext $context,
    ) { }

    public function createArea(): CreateAreaApi {
        return $this->create_area ??= new CreateAreaApi(
            $this->config->area->create_area,
            $this->context->areaService()
        );
    }

    public function activateArea(): ActivateAreaApi {
        return $this->activate_area ??= new ActivateAreaApi(
            $this->config->area->activate_area,
            $this->context->getService(),
            $this->context->areaService()
        );
    }

    public function archiveArea(): ArchiveAreaApi {
        return $this->archive_area ??= new ArchiveAreaApi(
            $this->config->area->archive_area,
            $this->context->getService(),
            $this->context->areaService()
        );
    }
        
    public function markAreaAsCrowded(): MarkAreaAsCrowdedApi {
        return $this->mark_area_as_crowded ??= new MarkAreaAsCrowdedApi(
            $this->config->area->mark_area_as_crowded,
            $this->context->getService(),
            $this->context->areaService()
        );
    }

    public function grantAreaAccess(): GrantAreaAccessApi {
        return $this->grant_area_access ??= new GrantAreaAccessApi(
            $this->config->area->grant_area_access,
            $this->context->getService(),
            $this->context->areaService()
        );
    }
    
    public function revokeAreaAccess(): RevokeAreaAccessApi {
        return $this->revoke_area_access ??= new RevokeAreaAccessApi(
            $this->config->area->revoke_area_access,
            $this->context->areaService(),
            $this->context->getService()
        );
    }
    
    public function addAreaName(): AddAreaNameApi {
        return $this->add_area_name ??= new AddAreaNameApi(
            $this->config->area->add_area_name,
            $this->context->getService(),
            $this->context->areaService()
        );
    }

    public function removeAreaName(): RemoveAreaNameApi {
        return $this->remove_area_name ??= new RemoveAreaNameApi(
            $this->config->area->remove_area_name,
            $this->context->getService(),
            $this->context->areaService()
        );
    }

    public function setPrimaryAreaName(): SetPrimaryAreaNameApi {
        return $this->set_primary_area_name ??= new SetPrimaryAreaNameApi(
            $this->config->area->set_primary_area_name,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->areaService()
        );
    }

    public function listArea(): ListAreaApi {
        return $this->list_area ??= new ListAreaApi(
            $this->config->area->list_area,
            $this->context->listService(),
        );
    }

    public function listAreaNames(): ListAreaNamesApi {
        return $this->list_area_names ??= new ListAreaNamesApi(
            $this->config->area->list_area_names,
            $this->context->getService(),
            $this->context->listService(),
        );
    }

    public function addZoneName(): AddZoneNameApi {
        return $this->add_zone_name ??= new AddZoneNameApi(
            $this->config->zone->add_zone_name,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }

    public function setPrimaryZoneName(): SetPrimaryZoneNameApi {
        return $this->set_primary_zone_name ??= new SetPrimaryZoneNameApi(
            $this->config->zone->set_primary_zone_name,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->zoneService()
        );
    }

    public function removeZoneName(): RemoveZoneNameApi {
        return $this->remove_zone_name ??= new RemoveZoneNameApi(
            $this->config->zone->remove_zone_name,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }

    public function createZone(): CreateZoneApi {
        return $this->create_zone ??= new CreateZoneApi(
            $this->config->zone->create_zone,
            $this->context->zoneService()
        );
    }
    
    public function activateZone(): ActivateZoneApi {
        return $this->activate_zone ??= new ActivateZoneApi(
            $this->config->zone->activate_zone,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }
    
    public function archiveZone(): ArchiveZoneApi {
        return $this->archive_zone ??= new ArchiveZoneApi(
            $this->config->zone->archive_zone,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }
        
    public function markZoneAsCrowded(): MarkZoneAsCrowdedApi {
        return $this->mark_zone_as_crowded ??= new MarkZoneAsCrowdedApi(
            $this->config->zone->mark_zone_as_crowded,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }

    public function listZone(): ListZoneApi {
        return $this->list_zone ??= new ListZoneApi(
            $this->config->zone->list_zone,
            $this->context->listService(),
        );
    }

    public function listZoneByArea(): ListZoneByAreaApi {
        return $this->list_zone_by_area ??= new ListZoneByAreaApi(
            $this->config->zone->list_zone_by_area,
            $this->context->getService(),
            $this->context->listService(),
        );
    }

    public function listZoneNames(): ListZoneNamesApi {
        return $this->list_zone_names ??= new ListZoneNamesApi(
            $this->config->zone->list_zone_names,
            $this->context->getService(),
            $this->context->listService(),
        );
    }

    public function createUser(): CreateUserApi {
        return $this->create_user ??= new CreateUserApi(
            $this->config->user->create_user,
            $this->context->userService()
        );
    }

    public function assignUserRole(): AssignUserRoleApi {
        return $this->assign_user_role ??= new AssignUserRoleApi(
            $this->config->user->assign_user_role,
            $this->context->getService(),
            $this->context->userService()
        );
    }

    public function dismissUserRole(): DismissUserRoleApi {
        return $this->dismiss_user_role ??= new DismissUserRoleApi(
            $this->config->user->dismiss_user_role,
            $this->context->getService(),
            $this->context->userService()
        );
    }

    public function addUserName(): AddUserNameApi {
        return $this->add_user_name ??= new AddUserNameApi(
            $this->config->user->add_user_name,
            $this->context->getService(),
            $this->context->userService()
        );
    }

    public function setPrimaryUserName(): SetPrimaryUserNameApi {
        return $this->set_primary_user_name ??= new SetPrimaryUserNameApi(
            $this->config->user->set_primary_user_name,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->userService()
        );
    }

    public function removeUserName(): RemoveUserNameApi {
        return $this->remove_user_name ??= new RemoveUserNameApi(
            $this->config->user->remove_user_name,
            $this->context->getService(),
            $this->context->userService()
        );
    }

    public function addUserIdentity(): AddUserIdentityApi {
        return $this->add_user_identity ??= new AddUserIdentityApi(
            $this->config->user->add_user_identity,
            $this->context->getService(),
            $this->context->userService()
        );
    }
    
    public function removeUserIdentity(): RemoveUserIdentityApi {
        return $this->remove_user_identity ??= new RemoveUserIdentityApi(
            $this->config->user->remove_user_identity,
            $this->context->getService(),
            $this->context->userService()
        );
    }

    public function activateUser(): ActivateUserApi {
        return $this->activate_user ??= new ActivateUserApi(
            $this->config->user->activate_user,
            $this->context->getService(),
            $this->context->userService()
        );
    }

    public function archiveUser(): ArchiveUserApi {
        return $this->archive_user ??= new ArchiveUserApi(
            $this->config->user->archive_user,
            $this->context->getService(),
            $this->context->userService()
        );
    }
    
    public function listUser(): ListUserApi {
        return $this->list_user ??=new ListUserApi(
            $this->config->user->list_user,
            $this->context->listService(),
        );
    }

    public function listUserIdentities(): ListUserIdentitiesApi {
        return $this->list_user_identities ??= new ListUserIdentitiesApi(
            $this->config->user->list_user_identities,
            $this->context->getService(),
            $this->context->listService()
        );
    }

    public function listUserNames(): ListUserNamesApi {
        return $this->list_user_names ??= new ListUserNamesApi(
            $this->config->user->list_user_names,
            $this->context->getService(),
            $this->context->listService()
        );
    }

    public function registerRack(): RegisterRackApi {
        return $this->register_rack ??= new RegisterRackApi(
            $this->config->rack->register_rack,
            $this->context->rackService()
        );
    }

    public function populateRack(): PopulateRackApi {
        return $this->populate_rack ??= new PopulateRackApi(
            $this->config->rack->populate_rack,
            $this->context->getService(),
            $this->context->rackService()
        );
    }
    
    public function activateRack(): ActivateRackApi {
        return $this->activate_rack ??= new ActivateRackApi(
            $this->config->rack->activate_rack,
            $this->context->getService(),
            $this->context->rackService()
        );
    }

    public function archiveRack(): ArchiveRackApi {
        return $this->archive_rack ??= new ArchiveRackApi(
            $this->config->rack->archive_rack,
            $this->context->getService(),
            $this->context->rackService()
        );
    }

    public function registerShelf(): RegisterShelfApi {
        return $this->register_shelf ??= new RegisterShelfApi(
            $this->config->shelf->register_shelf,
            $this->context->getService(),
            $this->context->shelfService()
        );
    }

    public function markShelfAsCrowded(): MarkShelfAsCrowdedApi {
        return $this->mark_shelf_as_crowded ??= new MarkShelfAsCrowdedApi(
            $this->config->shelf->mark_shelf_as_crowded,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->shelfService()
        );
    }

    public function removeShelf(): RemoveShelfApi {
        return $this->remove_shelf ??= new RemoveShelfApi(
            $this->config->shelf->remove_shelf,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->shelfService()
        );
    }

    public function registerStorageSlot(): RegisterStorageSlotApi {
        return $this->register_storage_slot ??= new RegisterStorageSlotApi(
            $this->config->storage_slot->register_storage_slot,
            $this->context->getService(),
            $this->context->storageSlotService()
        );
    }

    public function markStorageSlotAsCrowded(): MarkStorageSlotAsCrowdedApi {
        return $this->mark_storage_slot_as_crowded ??= new MarkStorageSlotAsCrowdedApi(
            $this->config->storage_slot->mark_storage_slot_as_crowded,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->storageSlotService()
        );
    }

    public function removeStorageSlot(): RemoveStorageSlotApi {
        return $this->remove_storage_slot ??= new RemoveStorageSlotApi(
            $this->config->storage_slot->remove_storage_slot,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->storageSlotService()
        );
    }

    public function addRackName(): AddRackNameApi {
        return $this->add_rack_name ??= new AddRackNameApi(
            $this->config->rack->add_rack_name,
            $this->context->getService(),
            $this->context->rackService()
        );
    }

    public function setPrimaryRackName(): SetPrimaryRackNameApi {
        return $this->set_primary_rack_name ??= new SetPrimaryRackNameApi(
            $this->config->rack->set_primary_rack_name,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->rackService()
        );
    }

    public function removeRackName(): RemoveRackNameApi {
        return $this->remove_rack_name ??= new RemoveRackNameApi(
            $this->config->rack->remove_rack_name,
            $this->context->getService(),
            $this->context->rackService()
        );
    }

    public function placeZoneToArea(): PlaceZoneToAreaApi {
        return $this->place_zone_to_area ??= new PlaceZoneToAreaApi(
            $this->config->zone->place_zone_to_area,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }
}