<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\ApiConfig;
use WarehouseCore\Context\ServiceContext;

use WarehouseCore\Api\Identity\CreateUserApi;
use WarehouseCore\Api\Catalog\Area\AddAreaNameApi;
use WarehouseCore\Api\Catalog\Area\RemoveAreaNameApi;
use WarehouseCore\Api\Catalog\Area\SetPrimaryAreaNameApi;
use WarehouseCore\Api\Topology\Area\ArchiveAreaApi;
use WarehouseCore\Api\Topology\Area\ActivateAreaApi;
use WarehouseCore\Api\Topology\Area\CreateAreaApi;
use WarehouseCore\Api\Topology\Area\MarkAreaAsCrowdedApi;
use WarehouseCore\Api\Identity\Area\GrantAreaAccessApi;
use WarehouseCore\Api\Identity\Area\RevokeAreaAccessApi;
use WarehouseCore\Api\Query\List\ListAreaApi;

final class ApiRegistry {
    public function __construct(
        private ApiConfig $config,
        private ServiceContext $context,
    ) { }

    public function createArea(): CreateAreaApi {
        return new CreateAreaApi(
            $this->config->create_area,
            $this->context->area_service
        );
    }

    public function activateArea(): ActivateAreaApi {
        return new ActivateAreaApi(
            $this->config->activate_area,
            $this->context->area_service
        );
    }

    public function archiveArea(): ArchiveAreaApi {
        return new ArchiveAreaApi(
            $this->config->archive_area,
            $this->context->area_service
        );
    }
        
    public function markAreaAsCrowded(): MarkAreaAsCrowdedApi {
        return new MarkAreaAsCrowdedApi(
            $this->config->mark_area_as_crowded,
            $this->context->area_service
        );
    }

    public function grantAreaAccess(): GrantAreaAccessApi {
        return new GrantAreaAccessApi(
            $this->config->grant_area_access,
            $this->context->area_service,
            $this->context->get_service
        );
    }
    
    public function revokeAreaAccess(): RevokeAreaAccessApi {
        return new RevokeAreaAccessApi(
            $this->config->revoke_area_access,
            $this->context->area_service,
            $this->context->get_service
        );
    }
    
    public function addAreaName(): AddAreaNameApi {
        return new AddAreaNameApi(
            $this->config->add_area_name,
            $this->context->area_service
        );
    }

    public function removeAreaName(): RemoveAreaNameApi {
        return new RemoveAreaNameApi(
            $this->config->remove_area_name,
            $this->context->area_service
        );
    }

    public function setPrimaryAreaName(): SetPrimaryAreaNameApi {
        return new SetPrimaryAreaNameApi(
            $this->config->set_primary_area_name,
            $this->context->area_service
        );
    }

    public function listArea(): ListAreaApi {
        return new ListAreaApi(
            $this->config->set_primary_area_name,
            $this->context->list_service,
        );
    }
    








    public function createUser(): CreateUserApi {
        return new CreateUserApi(
            $this->config->create_user,
            $this->context->find_service,
            $this->context->user_service
        );
    }



    // public function createUserIdentity(): CreateUserIdentityApi {
    //     return new CreateUserIdentityApi(
    //         $this->config->create_user_identity,
    //         $this->context->get_service,
    //         $this->context->find_service,
    //         $this->context->user_identity_service
    //     );
    // }

    // public function createPhysicalTag(): CreatePhysicalTagApi {
    //     return new CreatePhysicalTagApi(
    //         $this->config->create_physical_tag,
    //         $this->context->physical_tag_service,
    //         $this->context->get()
    //     );
    // }

    // public function createContainer(): CreateContainerApi {
    //     return new CreateContainerApi(
    //         $this->config->create_container,
    //         $this->context->container_,
    //         $this->context->get()
    //     );
    // }

    // public function assignPhysicalTag(): AssignPhysicalTagApi {
    //     return new AssignPhysicalTagApi(
    //         $this->config->assign_physical_tag,
    //         $this->context->physicalTag(),
    //         $this->context->item(),
    //         $this->context->get()
    //     );
    // }

    // public function placeItem(): PlaceItemApi {
    //     return new PlaceItemApi(
    //         $this->config->place_item,
    //         $this->context->placement(),
    //         $this->context->item(),
    //         $this->context->get(),
    //         $this->context->find()
    //     );
    // }
}