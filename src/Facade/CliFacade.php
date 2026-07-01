<?php
namespace WarehouseCore\Facade;

use WarehouseCore\Config\Config;
use WarehouseCore\Bootstrap\Setup;
use WarehouseCore\Registry\ServiceRegistry;
use WarehouseCore\Output\Output;
use WarehouseCore\Payload\DTO\AddressValue;

final class CliFacade {
    private ServiceRegistry $service;
    private Output $output;

    public function __construct (
        Config $config
    ){
        $this->service = Setup::Service($config);
        $this->output = Setup::Output('cli');
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

    public function AddLocation(
        string $zone, 
        string $rack,
        string $shelf
    ): void {
        $result = $this->service->AddLocation()->execute(
            new AddressValue(
                $zone,
                $rack,
                $shelf
            )
        );

        echo $this->output->render($result);
    }
    
}