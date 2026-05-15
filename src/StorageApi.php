<?php
namespace SuO0\StorageApi;

use SuO0\StorageApi\Connection\Connection;
use SuO0\StorageApi\Bootstrap\SetupRepository;
use SuO0\StorageApi\Bootstrap\SetupService;

class StorageApi {
    private SetupRepository $repo;
    private SetupService $scenario;

    public function __construct(array $config) {
        $this->repo = new SetupRepository(Connection::get($config['db']), $config['tables']);
        $this->scenario = new SetupService($this->repo);
    }

    public function __call(string $name, array $arguments) {
        if (!property_exists($this->scenario, $name)) 
            throw new \RuntimeException("Scenario [$name] not found" );
        
        $this->scenario->$name->execute(...$arguments);
    }
}