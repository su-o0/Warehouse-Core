<?php
namespace WarehouseCore\Facade;

use WarehouseCore\Config\Config;
use WarehouseCore\Bootstrap\Setup;
use WarehouseCore\Registry\ServiceRegistry;
use WarehouseCore\Output\Output;
use WarehouseCore\Payload\DTO\UserEntity;

final class CliFacade {
    private ServiceRegistry $service;
    private Output $output;
    private UserEntity $user;

    public function __construct (
        Config $config
    ){
        $this->service = Setup::Service($config);
        $this->output = Setup::Output('cli');
    }

    public function run() {
        $this->user = $this->service->authentication()->validate(
            'Cli',
            'admin'
        );
    }

    public static function create(): self {
        $config = Config::prepare([
            'database'     => require __DIR__ . '/../../config/database.php',
            'tables' => require __DIR__ . '/../../config/tables.php',
        ]);
        return new self($config);
    }

    public function createUser(
        string $name, 
        string $role
    ): string {
        $user = $this->service->user()->create(
            $name,
            $role
        );

        return $this->output->render($user);
    }

    public function createUserIdentity(
        string $user_id,
        string $provider,
        string $external_id
    ): string {
        $identity = $this->service->userIdentity()->createIdentity(
            $user_id,
            $provider,
            $external_id
        );

        return $this->output->render($identity);
    }
}