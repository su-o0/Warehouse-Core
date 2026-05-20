<?php
namespace WarehouseCore;

use WarehouseCore\Connection\Connection;
use WarehouseCore\Bootstrap\RepositoryRegistry;
use WarehouseCore\Bootstrap\ServiceRegistry;
use WarehouseCore\Exception\StorageException;

class WarehouseCore {
    private RepositoryRegistry $repo;
    private ServiceRegistry $service;

    public function __construct(array $config) {
        $this->repo = new RepositoryRegistry(Connection::get($config['db']), $config['tables']);
        $this->service = new ServiceRegistry($this->repo);
    }

    public function __call(string $name, array $arguments) {
        if (!property_exists($this->service, $name)) 
            throw StorageException::SERVICE_NOT_FOUND($name);
        
        $this->service->$name->execute(...$arguments);
    }
}