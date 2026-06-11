<?php
namespace WarehouseCore\Facade;

use WarehouseCore\Config\Config;
use WarehouseCore\Bootstrap\Setup;
use WarehouseCore\Registry\ServiceRegistry;
use WarehouseCore\Registry\OutputRegistry;

final class CliFacade {
    private ServiceRegistry $service;
    private OutputRegistry $output;

    public function __construct (
        Config $config
    ){
        $this->service = Setup::Service($config);
        $this->output = Setup::Output();
    }

    public function run() {
    }

    public static function create(): self {
        $config = Config::prepare([
            'database'     => require __DIR__ . '/../../config/database.php',
            'tables' => require __DIR__ . '/../../config/tables.php',
        ]);
        return new self($config);
    }

    public function Authentication(string $user_id): void {
       
        $user = $this->service->Authentication()->Validate($user_id);
        var_export($user);
    }

    public function AddUser(string $name, string $role_id) {
         $result = $this->service
            ->addUser()
            ->execute($name, (int)$role_id);

        // $this->output->
        
    }
}