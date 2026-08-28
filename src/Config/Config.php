<?php
namespace WarehouseCore\Config;

use WarehouseCore\Contract\Config as ContractConfig;

final readonly class Config implements ContractConfig {
    use ConfigHelper;   
    public function __construct(
        public DatabaseConfig $database,
        public RepositoryConfig $repository,
        public TransactionConfig $transaction,
        public ServiceConfig $service,
        public ApiConfig $api
    ) { }

    public static function prepare(array $raw): self {
        return new self(
            database: DatabaseConfig::fromRaw(self::required($raw, 'database')),
            repository: RepositoryConfig::fromRaw(self::required($raw, 'repository')),
            transaction: TransactionConfig::fromRaw(self::required($raw, 'transaction')),
            service: ServiceConfig::fromRaw(self::required($raw, 'service')),
            api: ApiConfig::fromRaw(self::required($raw, 'api'))
        );
    }
}