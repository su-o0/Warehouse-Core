<?php
namespace WarehouseCore\Facade;

use WarehouseCore\Config\Config;
use WarehouseCore\Bootstrap\Setup;
use WarehouseCore\Registry\ServiceRegistry;
use WarehouseCore\Registry\OutputRegistry;
use WarehouseCore\Payload\UserEntity;


final class RequireFacade {
    private ServiceRegistry $service;
    private OutputRegistry $output;
    private ?UserEntity $user = null;

    public function __construct (
        Config $config
    ){
        $this->service = Setup::Service($config);
        $this->output = Setup::Output();
    }

    public function run(string $user_id): self {
        $user = $this->service->Authentication()->validate($user_id);
        if($user === null)
            throw new \RuntimeException("Unauthorized: $user_id");
        
        $this->user = $user;
        return $this;
    }

    public static function create(int $userId): self {
        $config = Config::prepare([
            'db'     => require __DIR__ . '/../../config/database.php',
            'tables' => require __DIR__ . '/../../config/tables.php',
        ]);
        return (new self($config))->run($userId);
    }
}
