<?php
use SuO0\StorageApi\StorageApi;
require 'vendor/autoload.php';
$config = require 'config.php';
$storage = new StorageApi($config);

if (!isset($argv[1])) 
    die("Storage API Service:\n".
        "\tAddAddress <Address>\n".
        "\tAddContainer <ContainerId> [Box|Pallet]\n".
        "\tAddPhysicalTag <Id>\n".
        "\tAddItem <Address> <Tag> <Article> ?<IdCar>\n".
        "\tAddStock <Address> <Qcy> ?<Article>\n".
        "\tGetAddressContent <Address>\n".
        "\tPlaceContainerToLocation <ContainerId> <Address> \n".
        "\tPlaceStockToContainer <StockId> <ContainerId> \n".
        "\tPlaceItemToContainer <PhysicalTagId> <ContainerId> \n"
    );

try{
    $call = $argv[1]??null;
    $storage->$call($argv[2], $argv[3]??null, $argv[4]??null, $argv[5]??null);
}catch(\RuntimeException $e) {
    echo $e->getMessage()."\n";
}