<?php
namespace WarehouseCore\Bootstrap;

use WarehouseCore\Config\Config;
use WarehouseCore\Connection\Connection;
use WarehouseCore\Registry\RepositoryRegistry;
use WarehouseCore\Registry\ServiceRegistry;

use WarehouseCore\Output\Output;
use WarehouseCore\Registry\OutputFactory;

final class Setup {
    public static function Service(
        Config $config
    ): ServiceRegistry  {
        return new ServiceRegistry(
            new RepositoryRegistry(
                Connection::get($config->db), 
                $config->tables
            )
        );
    }

    public static function Output(string $runtime): Output {
        return match ($runtime) {
            'cli' => OutputFactory::cli(),
            'telegram' => OutputFactory::telegram(),
            default => throw new \RuntimeException("Unknown runtime")
        };
    }
}