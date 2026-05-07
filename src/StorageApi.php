<?php
namespace SuO0\StorageApi;

use SuO0\StorageApi\Connection\Connection;
use SuO0\StorageApi\Payload\SetupRepository;
use SuO0\StorageApi\Api\SetupApi;
use SuO0\StorageApi\Api\QueryApi;
use SuO0\StorageApi\Api\OperationsApi;

class StorageApi {
    private SetupRepository $repo;
    public SetupApi $Setup;
    public QueryApi $Query;
    public OperationsApi $Operations;

    public function __construct(array $config) {
        $this->repo = new SetupRepository(Connection::get($config['db']), $config['table']);
        $this->Setup = new SetupApi($this->repo);
        $this->Query = new QueryApi($this->repo);
        $this->Operations = new OperationsApi($this->repo);
    }
}