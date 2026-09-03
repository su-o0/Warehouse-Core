<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\TransactionConfig;
use WarehouseCore\Connection\Connection;
use WarehouseCore\Transaction\Area\AddAreaNameTransaction;
use WarehouseCore\Transaction\Zone\AddZoneNameTransaction;
use WarehouseCore\Transaction\Area\CreateAreaTransaction;
use WarehouseCore\Transaction\Zone\CreateZoneTransaction;
use WarehouseCore\Transaction\Area\SetPrimaryAreaNameTransaction;
use WarehouseCore\Transaction\User\AddUserIdentityTransaction;
use WarehouseCore\Transaction\User\AddUserNameTransaction;
use WarehouseCore\Transaction\Zone\SetPrimaryZoneNameTransaction;
use WarehouseCore\Transaction\User\AssignUserRoleTransaction;
use WarehouseCore\Transaction\User\DismissUserRoleTransaction;
use WarehouseCore\Transaction\User\RemoveUserIdentityTransaction;
use WarehouseCore\Transaction\User\RemoveUserNameTransaction;
use WarehouseCore\Transaction\User\SetPrimaryUserNameTransaction;

final class TransactionRegistry {
    public CreateAreaTransaction $create_area;
    public AddAreaNameTransaction $add_area_name;
    public SetPrimaryAreaNameTransaction $set_primary_area_name;

    public CreateZoneTransaction $create_zone;
    public AddZoneNameTransaction $add_zone_name;
    public SetPrimaryZoneNameTransaction $set_primary_zone_name;

    public AssignUserRoleTransaction $assign_user_role;
    public DismissUserRoleTransaction $dismiss_user_role;
    public AddUserNameTransaction $add_user_name;
    public SetPrimaryUserNameTransaction $set_primary_user_name;
    public RemoveUserNameTransaction $remove_user_name;
    public AddUserIdentityTransaction $add_user_identity;
    public RemoveUserIdentityTransaction $remove_user_identity;

    public function __construct(
        TransactionConfig $config,
        RepositoryRegistry $repository,
        Connection $connection,
    ) { 
        $db = $connection->get();

        $this->create_area = new CreateAreaTransaction(
            $db,
            $config->add_area_name,
            $repository->area,
            $repository->area_access,
            $repository->user
        );

        $this->add_area_name = new AddAreaNameTransaction(
            $db,
            $config->add_area_name,
            $repository->area_name, 
        );

        $this->set_primary_area_name = new SetPrimaryAreaNameTransaction(
            $db,
            $config->set_primary_area_name,
            $repository->area_name, 
        );

        $this->create_zone = new CreateZoneTransaction(
            $db,
            $config->add_zone_name,
            $repository->area,
            $repository->zone
        );

        $this->add_zone_name = new AddZoneNameTransaction(
            $db,
            $config->add_zone_name,
            $repository->zone_name, 
        );

        $this->set_primary_zone_name = new SetPrimaryZoneNameTransaction(
            $db,
            $config->set_primary_zone_name,
            $repository->zone_name, 
        );

        $this->assign_user_role = new AssignUserRoleTransaction(
            $db,
            $config->assign_user_role,
            $repository->user, 
            $repository->user_processing_step, 
        );

        $this->dismiss_user_role = new DismissUserRoleTransaction(
            $db,
            $config->dismiss_user_role,
            $repository->user, 
            $repository->user_processing_step, 
        );

        $this->add_user_name = new AddUserNameTransaction(
            $db,
            $config->add_area_name,
            $repository->user,
            $repository->user_name, 
            $repository->user_processing_step
        );

        $this->set_primary_user_name = new SetPrimaryUserNameTransaction(
            $db,
            $config->set_primary_zone_name,
            $repository->user_name, 
            $repository->user_processing_step
        );

        $this->remove_user_name = new RemoveUserNameTransaction(
            $db,
            $config->remove_user_name,
            $repository->user,
            $repository->user_name, 
            $repository->user_processing_step
        );

        $this->add_user_identity = new AddUserIdentityTransaction(
            $db,
            $config->add_user_identity,
            $repository->user,
            $repository->user_identity, 
            $repository->user_processing_step
        );

        $this->remove_user_identity = new RemoveUserIdentityTransaction(
            $db,
            $config->remove_user_identity,
            $repository->user,
            $repository->user_identity, 
            $repository->user_processing_step
        );
    }
}