<?php
use SuO0\StorageApi\StorageApi;
require 'vendor/autoload.php';
$config = [
    'db' => [
        'host' => '127.0.0.1',
        'dbname' => 'Storage',
        'user' => 'devuser',
        'password' => 'devnon',
    ],    
    'table' => [
        'Location' => 'Location',
        'Container' => 'Container',
        'PhysicalTag' => 'PhysicalTag',
        'Item' => 'Item',
        'Stock' => 'Stock',
        'Part' => 'Part',
        'Car' => 'Car',
        'ItemPhoto' => 'ItemPhoto',
        'StockPhoto' => 'StockPhoto',
        'CarPhoto' => 'CarPhoto',
        'SalesArhive' => 'SalesArhive',
        'History' => 'History',
        'Owner' => 'Owner',
    ]
]; 
$storage = new StorageApi($config);

switch($argv[1]) {
    case "AddAddress":
        try{
            $storage->AddAddress($argv[2]);
        }catch(\RuntimeException $e) {
            echo $e->getMessage()."\n";
        }
        break;
    case "AddContainer":
        try {
            $storage->AddContainer($argv[2], (int)$argv[3], $argv[4]);
        }catch(\RuntimeException $e) {
            echo $e->getMessage()."\n";
        }
        break;
    case "AddStock":
        try {
            $storage->AddStock($argv[2], $argv[3], isset($argv[4])?$argv[4]:null);
        }catch(\RuntimeException $e) {
            echo $e->getMessage()."\n";
        }
        break;
    default: 
        echo "Storage API:\n".
        "AddContainer <Address>\n".
        "AddContainer <Address> <ContainerId> <Type>\n".
        "AddStock <ContainerId> <Qcy> ?<Article>";
}
