<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\TransactionConfig;
use WarehouseCore\Connection\Connection;
use WarehouseCore\Transaction\Area\AddAreaNameTransaction;
use WarehouseCore\Transaction\Zone\AddZoneNameTransaction;
use WarehouseCore\Transaction\Area\CreateAreaTransaction;
use WarehouseCore\Transaction\Zone\CreateZoneTransaction;
use WarehouseCore\Transaction\Area\SetPrimaryAreaNameTransaction;
use WarehouseCore\Transaction\Rack\ActivateRackTransaction;
use WarehouseCore\Transaction\Rack\AddRackNameTransaction;
use WarehouseCore\Transaction\Rack\ArchiveRackTransaction;
use WarehouseCore\Transaction\Rack\PopulateRackTransaction;
use WarehouseCore\Transaction\Rack\SetPrimaryRackNameTransaction;
use WarehouseCore\Transaction\User\AddUserIdentityTransaction;
use WarehouseCore\Transaction\User\AddUserNameTransaction;
use WarehouseCore\Transaction\Zone\SetPrimaryZoneNameTransaction;
use WarehouseCore\Transaction\User\AssignUserRoleTransaction;
use WarehouseCore\Transaction\User\DismissUserRoleTransaction;
use WarehouseCore\Transaction\User\RemoveUserIdentityTransaction;
use WarehouseCore\Transaction\User\RemoveUserNameTransaction;
use WarehouseCore\Transaction\User\SetPrimaryUserNameTransaction;

final class TransactionRegistry {
    private \PDO $db;

    private ?CreateAreaTransaction $create_area = null;
    private ?AddAreaNameTransaction $add_area_name = null;
    private ?SetPrimaryAreaNameTransaction $set_primary_area_name = null;

    private ?AddZoneNameTransaction $add_zone_name = null;
    private ?SetPrimaryZoneNameTransaction $set_primary_zone_name = null;

    private ?AssignUserRoleTransaction $assign_user_role = null;
    private ?DismissUserRoleTransaction $dismiss_user_role = null;
    private ?AddUserNameTransaction $add_user_name = null;
    private ?SetPrimaryUserNameTransaction $set_primary_user_name = null;
    private ?RemoveUserNameTransaction $remove_user_name = null;
    private ?AddUserIdentityTransaction $add_user_identity = null;
    private ?RemoveUserIdentityTransaction $remove_user_identity = null;

    private ?PopulateRackTransaction $populate_rack = null;
    private ?ActivateRackTransaction $activate_rack = null;
    private ?ArchiveRackTransaction $archive_rack = null;
    private ?AddRackNameTransaction $add_rack_name = null;
    private ?SetPrimaryRackNameTransaction $set_primary_rack_name = null;

    public function __construct(
        private TransactionConfig $config,
        private RepositoryRegistry $repository,
        Connection $connection,
    ) { 
        $this->db = $connection->get();
    }

    public function createArea(): CreateAreaTransaction {
        return $this->create_area ??= new CreateAreaTransaction(
            $this->db,
            $this->config->add_area_name,
            $this->repository->area(),
            $this->repository->areaAccess(),
            $this->repository->user()
        );
    }
        
    public function addAreaName(): AddAreaNameTransaction {
        return $this->add_area_name ??= new AddAreaNameTransaction(
            $this->db,
            $this->config->add_area_name,
            $this->repository->areaName(), 
        );
    }

    public function setPrimaryAreaName(): SetPrimaryAreaNameTransaction {
        return $this->set_primary_area_name ??= new SetPrimaryAreaNameTransaction(
            $this->db,
            $this->config->set_primary_area_name,
            $this->repository->areaName(), 
        );
    }

    public function addZoneName(): AddZoneNameTransaction {
        return $this->add_zone_name ??= new AddZoneNameTransaction(
            $this->db,
            $this->config->add_zone_name,
            $this->repository->zoneName(), 
        );
    }

    public function setPrimaryZoneName(): SetPrimaryZoneNameTransaction {
        return $this->set_primary_zone_name ??= new SetPrimaryZoneNameTransaction(
            $this->db,
            $this->config->set_primary_zone_name,
            $this->repository->zoneName(), 
        );
    }

    public function assignUserRole(): AssignUserRoleTransaction {
        return $this->assign_user_role ??= new AssignUserRoleTransaction(
            $this->db,
            $this->config->assign_user_role,
            $this->repository->user(), 
            $this->repository->userProcessingStep(), 
        );
    }

    public function dismissUserRole(): DismissUserRoleTransaction {
        return $this->dismiss_user_role ??= new DismissUserRoleTransaction(
            $this->db,
            $this->config->dismiss_user_role,
            $this->repository->user(), 
            $this->repository->userProcessingStep(), 
        );
    }

    public function addUserName(): AddUserNameTransaction {
        return $this->add_user_name ??= new AddUserNameTransaction(
            $this->db,
            $this->config->add_area_name,
            $this->repository->user(),
            $this->repository->userName(), 
            $this->repository->userProcessingStep()
        );
    }

    public function setPrimaryUserName(): SetPrimaryUserNameTransaction {
        return $this->set_primary_user_name ??= new SetPrimaryUserNameTransaction(
            $this->db,
            $this->config->set_primary_zone_name,
            $this->repository->userName(), 
            $this->repository->userProcessingStep()
        );
    }

    public function removeUserName(): RemoveUserNameTransaction {
        return $this->remove_user_name ??= new RemoveUserNameTransaction(
            $this->db,
            $this->config->remove_user_name,
            $this->repository->user(),
            $this->repository->userName(), 
            $this->repository->userProcessingStep()
        );
    }

    public function addUserIdentity(): AddUserIdentityTransaction {
        return $this->add_user_identity ??= new AddUserIdentityTransaction(
            $this->db,
            $this->config->add_user_identity,
            $this->repository->user(),
            $this->repository->userIdentity(), 
            $this->repository->userProcessingStep()
        );
    }

    public function removeUserIdentity(): RemoveUserIdentityTransaction {
        return $this->remove_user_identity ??= new RemoveUserIdentityTransaction(
            $this->db,
            $this->config->remove_user_identity,
            $this->repository->user(),
            $this->repository->userIdentity(), 
            $this->repository->userProcessingStep()
        );
    }

    public function populateRack(): PopulateRackTransaction {
        return $this->populate_rack ??= new PopulateRackTransaction(
            $this->db,
            $this->config->populate_rack,
            $this->repository->rack(),
            $this->repository->shelf(),
            $this->repository->storageSlot(),
            $this->repository->rackProcessingStep()
        );
    }

    public function activateRack(): ActivateRackTransaction {
        return $this->activate_rack ??= new ActivateRackTransaction(
            $this->db,
            $this->config->activate_rack,
            $this->repository->rack(),
            $this->repository->shelf(),
            $this->repository->storageSlot(),
        );
    }
 
    public function archiveRack(): ArchiveRackTransaction {
        return $this->archive_rack ??= new ArchiveRackTransaction(
            $this->db,
            $this->config->archive_rack,
            $this->repository->rack(),
            $this->repository->shelf(),
            $this->repository->storageSlot(),
        );
    }

    public function addRackName(): AddRackNameTransaction {
        return $this->add_rack_name ??= new AddRackNameTransaction(
            $this->db,
            $this->config->add_rack_name,
            $this->repository->rackName()
        );
    }

    public function setPrimaryRackName(): SetPrimaryRackNameTransaction {
        return $this->set_primary_rack_name ??= new SetPrimaryRackNameTransaction(
            $this->db,
            $this->config->set_primary_rack_name,
            $this->repository->rackName()
        );
    }
}