<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Api\Identity\CreatePhysicalTagApi;
use WarehouseCore\Config\ApiConfig;
use WarehouseCore\Context\ServiceContext;

use WarehouseCore\Api\Identity\CreateUserApi;
use WarehouseCore\Api\Identity\CreateUserIdentityApi;
use WarehouseCore\Api\Inventory\CreateContainerApi;
use WarehouseCore\Api\Inventory\AssignPhysicalTagApi;
use WarehouseCore\Api\Query\Location\GetLocationApi;
use WarehouseCore\Api\Query\Location\ListLocationsApi;
use WarehouseCore\Api\Topology\ActivateLocationApi;
use WarehouseCore\Api\Topology\ArchiveLocationApi;
use WarehouseCore\Api\Topology\CreateLocationApi;

final class ApiRegistry {
    public function __construct(
        private ServiceContext $context,
        private ApiConfig $config,
    ) { }

    public function createUser(): CreateUserApi {
        return new CreateUserApi(
            $this->config->create_user,
            $this->context->find(),
            $this->context->user()
        );
    }

    public function createUserIdentity(): CreateUserIdentityApi {
        return new CreateUserIdentityApi(
            $this->config->create_user_identity,
            $this->context->get(),
            $this->context->find(),
            $this->context->userIdentity()
        );
    }

    public function createPhysicalTag(): CreatePhysicalTagApi {
        return new CreatePhysicalTagApi(
            $this->config->create_physical_tag,
            $this->context->physicalTag(),
            $this->context->get()
        );
    }

    public function createLocation(): CreateLocationApi {
        return new CreateLocationApi(
            $this->config->create_location,
            $this->context->location(),
            $this->context->find()
        );
    }
    public function createContainer(): CreateContainerApi {
        return new CreateContainerApi(
            $this->config->create_container,
            $this->context->container(),
            $this->context->get()
        );
    }

    public function assignPhysicalTag(): AssignPhysicalTagApi {
        return new AssignPhysicalTagApi(
            $this->config->assign_physical_tag,
            $this->context->physicalTag(),
            $this->context->item(),
            $this->context->get()
        );
    }

    public function activateLocation(): ActivateLocationApi {
        return new ActivateLocationApi(
            $this->config->activate_location,
            $this->context->location(),
            $this->context->get()
        );
    }

    public function archiveLocation(): ArchiveLocationApi {
        return new ArchiveLocationApi(
            $this->config->archive_location,
            $this->context->location(),
            $this->context->get()
        );
    }

    public function getLocation(): GetLocationApi {
        return new GetLocationApi(
            $this->config->get_location,
            $this->context->get()
        );
    }

    public function listLocations(): ListLocationsApi {
        return new ListLocationsApi (
            $this->config->list_locations,
            $this->context->get()
        );
    }
}