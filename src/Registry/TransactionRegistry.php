<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\TransactionConfig;
use WarehouseCore\Connection\Connection;
use WarehouseCore\Transaction\Area\AddAreaNameTransaction;
use WarehouseCore\Transaction\Zone\AddZoneNameTransaction;
use WarehouseCore\Transaction\Area\CreateAreaTransaction;
use WarehouseCore\Transaction\Zone\CreateZoneTransaction;
use WarehouseCore\Transaction\Area\SetPrimaryAreaNameTransaction;
use WarehouseCore\Transaction\Zone\SetPrimaryZoneNameTransaction;

final class TransactionRegistry {
    public CreateAreaTransaction $create_area;
    public AddAreaNameTransaction $add_area_name;
    public SetPrimaryAreaNameTransaction $set_primary_area_name;
    public CreateZoneTransaction $create_zone;
    public AddZoneNameTransaction $add_zone_name;
    public SetPrimaryZoneNameTransaction $set_primary_zone_name;

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
    }
}