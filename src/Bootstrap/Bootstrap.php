<?php
namespace WarehouseCore\Bootstrap;

use WarehouseCore\Config\Config;
use WarehouseCore\Connection\Connection;
use WarehouseCore\Context\ServiceContext;
use WarehouseCore\Service\Identity\AuthenticationService;

use WarehouseCore\Registry\ApiHandlerRegistry;
use WarehouseCore\Registry\ApiRegistry;
use WarehouseCore\Registry\RepositoryRegistry;
use WarehouseCore\Registry\TransactionRegistry;
use WarehouseCore\Registry\ServiceRegistry;

final class Bootstrap {
    private ?Connection $connection = null;
    private ?RepositoryRegistry $repository_registry = null;
    private ?TransactionRegistry $transaction_registry = null;
    private ?ServiceRegistry $service_registry = null;
    
    public function __construct(
        private readonly Config $config
    ) { }

    public static function create(): self {
        $config = Config::prepare([
            'api'           => require __DIR__ . '/../../config/api.php',
            'database'      => require __DIR__ . '/../../config/database.php',
            'repository'    => require __DIR__ . '/../../config/repository.php',
            'service'       => require __DIR__ . '/../../config/service.php',
            'transaction'   => require __DIR__ . '/../../config/transaction.php'
        ]);

        return new self($config);
    }

    private function connection(): Connection {
        if ($this->connection === null) {
            $this->connection = new Connection(
                config: $this->config->database,
                journal_table: $this->config->repository->journal
            );
        }
        return $this->connection;
    }

    private function repository_registry(): RepositoryRegistry {
        if ($this->repository_registry === null) {
            $this->repository_registry = new RepositoryRegistry(
                config: $this->config->repository,
                connection: $this->connection()
            );
        }
        return $this->repository_registry;
    }

    private function transaction_registry(): TransactionRegistry {
        if ($this->transaction_registry === null) {
            $this->transaction_registry = new TransactionRegistry(
                config: $this->config->transaction,
                repository: $this->repository_registry(),
                connection: $this->connection()
            );
        }
        return $this->transaction_registry;
    }

    public function buildAuthentication(): AuthenticationService {
        $repository = $this->repository_registry();

        return new AuthenticationService(
            service_name: $this->config->service->authentication,
            role_repository: $repository->role,
            provider_repository: $repository->provider,
            user_repository: $repository->user,
            user_identity_repository: $repository->user_identity
        );
    }

    public function buildService(): ServiceRegistry {
        if ($this->service_registry === null) {
            $this->service_registry = new ServiceRegistry(
                config: $this->config->service,
                repository: $this->repository_registry(),
                transaction: $this->transaction_registry()
            );
        }
        return $this->service_registry;
    }

    public function buildApi(
        ServiceContext $context
    ): ApiHandlerRegistry {
        return new ApiHandlerRegistry(
            api: new ApiRegistry(
                config: $this->config->api,
                context: $context
            )
        );
    }
}