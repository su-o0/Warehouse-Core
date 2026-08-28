<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\TransactionConfig;
use WarehouseCore\Connection\Connection;
use WarehouseCore\Transaction\Area\AddAreaNameTransaction;
use WarehouseCore\Transaction\Area\CreateAreaTransaction;
use WarehouseCore\Transaction\Area\SetPrimaryAreaNameTransaction;

final class TransactionRegistry {
    public CreateAreaTransaction $create_area;
    public AddAreaNameTransaction $add_area_name;
    public SetPrimaryAreaNameTransaction $set_primary_area_name;

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

        $this->create_area = new CreateAreaTransaction(
            $db,
            $config->create_area,
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
    }
}