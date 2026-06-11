<?php 
namespace WarehouseCore\Connection;

class Connection {
    private static ?\PDO $instance = null;
    
    public static function get(mixed $config): \PDO {
        if (self::$instance === null) {
            self::$instance = new \PDO(      
                "mysql:host={$config->host};dbname={$config->dbname};charset=utf8mb4",
                $config->user,
                $config->password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]
            );
        }
        return self::$instance;
    }
}