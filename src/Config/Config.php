<?php
namespace WarehouseCore\Config;

final class Config {
    use ConfigHelper;   
    public function __construct(
        public DatabaseConfig $db,
        public RepositoryConfig $repository,
        public ServiceConfig $service,
        public ApiConfig $api
    ) { }

    public static function prepare(array $raw): self {
        return new self(
            db: DatabaseConfig::fromRaw(self::required($raw, 'database')),
            repository: RepositoryConfig::fromRaw(self::required($raw, 'repository')),
            service: ServiceConfig::fromRaw(self::required($raw, 'service')),
            api: ApiConfig::fromRaw(self::required($raw, 'api'))
        );
    }
}