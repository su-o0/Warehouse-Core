<?php
namespace WarehouseCore\Bootstrap;

use WarehouseCore\Config\Config;
use WarehouseCore\Connection\Connection;
use WarehouseCore\Registry\RepositoryRegistry;
use WarehouseCore\Registry\ServiceRegistry;
use WarehouseCore\Registry\ApiRegistry;

use WarehouseCore\Context\ServiceContext;
use WarehouseCore\Api\ApiHandler;

use WarehouseCore\Service\Identity\AuthenticationService;

final class Bootstrap {
    private readonly RepositoryRegistry $repository_registry;
    public function __construct(
        private readonly Config $config
    ) {
        $this->repository_registry = new RepositoryRegistry(
            Connection::get($this->config->db),
            $this->config->repository
        );
     }

    public static function create(): self {
        return new self ( 
            Config::prepare([
                'database'      => require __DIR__ . '/../../config/database.php',
                'repository'    => require __DIR__ . '/../../config/repository.php',
                'service'       => require __DIR__ . '/../../config/service.php',
                'api'           => require __DIR__ . '/../../config/api.php'
            ])
        );
    }

    public function buildAuthentication(
    ): AuthenticationService {
        return new AuthenticationService(
            $this->config->service->authentication,
            $this->repository_registry->role,
            $this->repository_registry->user,
            $this->repository_registry->user_identity
        );
    }

    public function buildService(
    ): ServiceRegistry {
        return new ServiceRegistry(
            $this->repository_registry,
            $this->config->service,
        );
    }   

    public function buildApi(
        ServiceContext $context
    ): ApiHandler {
        return new ApiHandler(
            new ApiRegistry(
                $context,
                $this->config->api    
            )
        );
    }
}