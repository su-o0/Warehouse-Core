<?php
namespace WarehouseCore\Facade;

use WarehouseCore\Config\Config;
use WarehouseCore\Bootstrap\Setup;
use WarehouseCore\Registry\ServiceRegistry;
use WarehouseCore\Payload\Value\AddressValue;
use WarehouseCore\Payload\DTO\UserEntity;

final class RequireFacade {
    private ServiceRegistry $service;
    public ?UserEntity $user = null;

    public function __construct (
        Config $config
    ){
        $this->service = Setup::Service($config);
    }

    private function run(string $user_id): null|self {
        $this->user = $this->service->Authentication()->validate($user_id);
        if($this->user === null)
            return null;
        return $this;
    }

    public static function create(int $userId): null|self {
        $config = Config::prepare([
            'database'     => require __DIR__ . '/../../config/database.php',
            'tables' => require __DIR__ . '/../../config/tables.php',
        ]);
        return (new self($config))->run($userId);
    }

    public function AddLocation(
        string $zone, 
        string $rack,
        string $shelf
    ): object {
        return $this->service->AddLocation()->execute(
            new AddressValue(
                $zone,
                $rack,
                $shelf
            )
        );
    }

    public function AddContainer(
        string $container_id,
        string $type
    ): object {
        return $this->service->AddContainer()->execute(
            $container_id,
            $type
        );
    }

    public function AddStock(
        string $article,
        string $qcy
    ):object {
        return $this->service->AddStock()->execute(
            $article,
            $qcy
        );
    }

    public function CreateItem(
        string $article
    ): object {
        return $this->service->createItem()->execute(
            ''
            $article,


        );
    }
}
