<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Config\ApiConfig;
use WarehouseCore\Context\ServiceContext;

use WarehouseCore\Api\Identity\CreateUser;
use WarehouseCore\Api\Identity\CreateUserIdentity;

final class ApiRegistry {
    public function __construct(
        private ServiceContext $context,
        private ApiConfig $config,
    ) { }

    public function createUser(): CreateUser {
        return new CreateUser(
            $this->config->create_user,
            $this->context->find(),
            $this->context->user()
        );
    }

    public function createUserIdentity(): CreateUserIdentity {
        return new CreateUserIdentity(
            $this->config->create_user_identity,
            $this->context->find(),
            $this->context->userIdentity()
        );
    }
}