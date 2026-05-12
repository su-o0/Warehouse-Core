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
        'Placement' => 'Placement',
        'Container' => 'Container',
        'PhysicalTag' => 'PhysicalTag',
        'Item' => 'Item',
        'Stock' => 'Strock',
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