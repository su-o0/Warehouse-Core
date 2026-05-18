<?php
namespace StorageApi;

use StorageApi\Connection\Connection;
use StorageApi\Bootstrap\SetupRepository;
use StorageApi\Bootstrap\SetupService;
use StorageApi\Exception\StorageException;

class StorageApi {
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