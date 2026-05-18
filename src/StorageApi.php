<?php
namespace StorageApi;

use StorageApi\Connection\Connection;
use StorageApi\Bootstrap\SetupRepository;
use StorageApi\Bootstrap\SetupService;

class StorageApi {
    private SetupRepository $repo;
    private SetupService $service;

    public function __construct(array $config) {
        $this->repo = new SetupRepository(Connection::get($config['db']), $config['tables']);
        $this->service = new SetupService($this->repo);
    }

    public function __call(string $name, array $arguments) {
        if (!property_exists($this->service, $name)) 
            throw new \RuntimeException("Service [$name] not found" );
        
        $this->service->$name->execute(...$arguments);
    }
}