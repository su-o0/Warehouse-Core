<?php
namespace WarehouseCore;

use WarehouseCore\Connection\Connection;
use WarehouseCore\Bootstrap\SetupRepository;
use WarehouseCore\Bootstrap\SetupService;
use WarehouseCore\Exception\StorageException;

class WarehouseCore {
    private SetupRepository $repo;
    private SetupService $service;

    public function __construct(array $config) {
        $this->repo = new SetupRepository(Connection::get($config['db']), $config['tables']);
        $this->service = new SetupService($this->repo);
    }

    public function __call(string $name, array $arguments) {
        if (!property_exists($this->service, $name)) 
            throw StorageException::SERVICE_NOT_FOUND($name);
        
        $this->service->$name->execute(...$arguments);
    }
}