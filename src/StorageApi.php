<?php
namespace SuO0\StorageApi;

use SuO0\StorageApi\Connection\Connection;
use SuO0\StorageApi\Bootstrap\SetupRepository;
use SuO0\StorageApi\Bootstrap\SetupScenario;

class StorageApi {
    private SetupRepository $repo;
    private SetupScenario $scenario;

    public function __construct(array $config) {
        $this->repo = new SetupRepository(Connection::get($config['db']), $config['table']);
        $this->scenario = new SetupScenario($this->repo);
    }

    public function __call(string $name, array $arguments) {
        if (!property_exists($this->scenario, $name)) 
            throw new \RuntimeException("Scenario [$name] not found" );
        
        $this->scenario->$name->execute(...$arguments);
    }
}