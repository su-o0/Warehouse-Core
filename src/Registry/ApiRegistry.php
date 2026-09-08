<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\ApiConfig;
use WarehouseCore\Context\ServiceContext;

use WarehouseCore\Api\Catalog\Area\AddAreaNameApi;
use WarehouseCore\Api\Catalog\Area\RemoveAreaNameApi;
use WarehouseCore\Api\Catalog\Area\SetPrimaryAreaNameApi;
use WarehouseCore\Api\Catalog\User\AddUserNameApi;
use WarehouseCore\Api\Catalog\User\RemoveUserNameApi;
use WarehouseCore\Api\Catalog\User\SetPrimaryUserNameApi;
use WarehouseCore\Api\Catalog\Zone\AddZoneNameApi;
use WarehouseCore\Api\Catalog\Zone\RemoveZoneNameApi;
use WarehouseCore\Api\Catalog\Zone\SetPrimaryZoneNameApi;
use WarehouseCore\Api\Topology\Area\ArchiveAreaApi;
use WarehouseCore\Api\Topology\Area\ActivateAreaApi;
use WarehouseCore\Api\Topology\Area\CreateAreaApi;
use WarehouseCore\Api\Topology\Area\MarkAreaAsCrowdedApi;
use WarehouseCore\Api\Identity\Area\GrantAreaAccessApi;
use WarehouseCore\Api\Identity\Area\RevokeAreaAccessApi;
use WarehouseCore\Api\Identity\User\ActivateUserApi;
use WarehouseCore\Api\Identity\User\AddUserIdentityApi;
use WarehouseCore\Api\Identity\User\ArchiveUserApi;
use WarehouseCore\Api\Identity\User\AssignUserRoleApi;
use WarehouseCore\Api\Identity\User\CreateUserApi;
use WarehouseCore\Api\Identity\User\DismissUserRoleApi;
use WarehouseCore\Api\Identity\User\RemoveUserIdentityApi;
use WarehouseCore\Api\Inventory\Rack\PopulateRackApi;
use WarehouseCore\Api\Inventory\Rack\RegisterRackApi;
use WarehouseCore\Api\Query\List\ListAreaApi;
use WarehouseCore\Api\Query\List\ListAreaNamesApi;
use WarehouseCore\Api\Query\List\ListUserApi;
use WarehouseCore\Api\Query\List\ListUserIdentitiesApi;
use WarehouseCore\Api\Query\List\ListZoneByAreaApi;
use WarehouseCore\Api\Query\List\ListZoneNamesApi;
use WarehouseCore\Api\Query\List\ListUserNamesApi;
use WarehouseCore\Api\Topology\Zone\ActivateZoneApi;
use WarehouseCore\Api\Topology\Zone\ArchiveZoneApi;
use WarehouseCore\Api\Topology\Zone\CreateZoneApi;
use WarehouseCore\Api\Topology\Zone\MarkZoneAsCrowdedApi;

final class ApiRegistry {
    public function __construct(
        private ApiConfig $config,
        private ServiceContext $context,
    ) { }

    public function createArea(): CreateAreaApi {
        return new CreateAreaApi(
            $this->config->create_area,
            $this->context->areaService()
        );
    }

    public function activateArea(): ActivateAreaApi {
        return new ActivateAreaApi(
            $this->config->activate_area,
            $this->context->getService(),
            $this->context->areaService()
        );
    }

    public function archiveArea(): ArchiveAreaApi {
        return new ArchiveAreaApi(
            $this->config->archive_area,
            $this->context->getService(),
            $this->context->areaService()
        );
    }
        
    public function markAreaAsCrowded(): MarkAreaAsCrowdedApi {
        return new MarkAreaAsCrowdedApi(
            $this->config->mark_area_as_crowded,
            $this->context->getService(),
            $this->context->areaService()
        );
    }

    public function grantAreaAccess(): GrantAreaAccessApi {
        return new GrantAreaAccessApi(
            $this->config->grant_area_access,
            $this->context->getService(),
            $this->context->areaService()
        );
    }
    
    public function revokeAreaAccess(): RevokeAreaAccessApi {
        return new RevokeAreaAccessApi(
            $this->config->revoke_area_access,
            $this->context->areaService(),
            $this->context->getService()
        );
    }
    
    public function addAreaName(): AddAreaNameApi {
        return new AddAreaNameApi(
            $this->config->add_area_name,
            $this->context->getService(),
            $this->context->areaService()
        );
    }

    public function removeAreaName(): RemoveAreaNameApi {
        return new RemoveAreaNameApi(
            $this->config->remove_area_name,
            $this->context->getService(),
            $this->context->areaService()
        );
    }

    public function setPrimaryAreaName(): SetPrimaryAreaNameApi {
        return new SetPrimaryAreaNameApi(
            $this->config->set_primary_area_name,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->areaService()
        );
    }

    public function addZoneName(): AddZoneNameApi {
        return new AddZoneNameApi(
            $this->config->set_primary_area_name,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }

    public function setPrimaryZoneName(): SetPrimaryZoneNameApi {
        return new SetPrimaryZoneNameApi(
            $this->config->set_primary_zone_name,
            $this->context->getService(),
            $this->context->findService(),
            $this->context->zoneService()
        );
    }

    public function removeZoneName(): RemoveZoneNameApi {
        return new RemoveZoneNameApi(
            $this->config->remove_zone_name,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }

    public function createZone(): CreateZoneApi {
        return new CreateZoneApi(
            $this->config->create_zone,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }
    
    public function activateZone(): ActivateZoneApi {
        return new ActivateZoneApi(
            $this->config->activate_zone,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }
    
    public function archiveZone(): ArchiveZoneApi {
        return new ArchiveZoneApi(
            $this->config->archive_zone,
            $this->context->zoneService()
        );
    }
        
    public function markZoneAsCrowded(): MarkZoneAsCrowdedApi {
        return new MarkZoneAsCrowdedApi(
            $this->config->mark_zone_as_crowded,
            $this->context->getService(),
            $this->context->zoneService()
        );
    }

    public function listArea(): ListAreaApi {
        return new ListAreaApi(
            $this->config->list_area,
            $this->context->listService(),
        );
    }

    public function listUser(): ListUserApi {
        return new ListUserApi(
            $this->config->list_user,
            $this->context->listService(),
        );
    }

    public function listAreaNames(): ListAreaNamesApi {
        return new ListAreaNamesApi(
            $this->config->list_area_names,
            $this->context->getService(),
            $this->context->listService(),
        );
    }

    public function listZoneByArea(): ListZoneByAreaApi {
        return new ListZoneByAreaApi(
            $this->config->list_zone_by_area,
            $this->context->getService(),
            $this->context->listService(),
        );
    }

    public function listZoneNames(): ListZoneNamesApi {
        return new ListZoneNamesApi(
            $this->config->list_zone_names,
            $this->context->getService(),
            $this->context->listService(),
        );
    }

    public function createUser(): CreateUserApi {
        return new CreateUserApi(
            $this->config->create_user,
            $this->context->userService()
        );
    }

    public function assignUserRole(): AssignUserRoleApi {
        return new AssignUserRoleApi(
            $this->config->assign_user_role,
            $this->context->userService()
        );
    }

    public function dismissUserRole(): DismissUserRoleApi {
        return new DismissUserRoleApi(
            $this->config->dismiss_user_role,
            $this->context->userService()
        );
    }

    public function addUserName(): AddUserNameApi {
        return new AddUserNameApi(
            $this->config->add_user_name,
            $this->context->userService()
        );
    }

    public function setPrimaryUserName(): SetPrimaryUserNameApi {
        return new SetPrimaryUserNameApi(
            $this->config->set_primary_user_name,
            $this->context->userService()
        );
    }

    public function removeUserName(): RemoveUserNameApi {
        return new RemoveUserNameApi(
            $this->config->remove_user_name,
            $this->context->userService()
        );
    }

    public function addUserIdentity(): AddUserIdentityApi {
        return new AddUserIdentityApi(
            $this->config->add_user_identity,
            $this->context->userService()
        );
    }
    
    public function removeUserIdentity(): RemoveUserIdentityApi {
        return new RemoveUserIdentityApi(
            $this->config->remove_user_identity,
            $this->context->userService()
        );
    }

    public function listUserIdentities(): ListUserIdentitiesApi {
        return new ListUserIdentitiesApi(
            $this->config->list_user_identities,
            $this->context->getService(),
            $this->context->listService()
        );
    }

    public function listUserNames(): ListUserNamesApi {
        return new ListUserNamesApi(
            $this->config->list_user_names,
            $this->context->getService(),
            $this->context->listService()
        );
    }

    public function activateUser(): ActivateUserApi {
        return new ActivateUserApi(
            $this->config->activate_user,
            $this->context->userService()
        );
    }

    public function archiveUser(): ArchiveUserApi {
        return new ArchiveUserApi(
            $this->config->archive_user,
            $this->context->userService()
        );
    }

    public function registerRack(): RegisterRackApi {
        return new RegisterRackApi(
            $this->config->register_rack,
            $this->context->rackService()
        );
    }

    public function populateRack(): PopulateRackApi {
        return new PopulateRackApi(
            $this->config->populate_rack,
            $this->context->rackService()
        );
    }
}