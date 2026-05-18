<?php
use StorageApi\StorageApi;
require 'vendor/autoload.php';
$config = require 'config.php';
$storage = new StorageApi($config);

if (!isset($argv[1])) 
die(
    "Storage API:"
    ."\tSetup:"
    ."\t\taddAddress \n"
    ."\t\taddContainer \n"
    ."\t\taddPhysicalTag \n"
    ."\t\taddOwner \n"
    ."\t\taddCar \n"
    ."\t\taddItem \n"
    ."\t\taddStock \n"

    ."\tPlacement \n"
    ."\t\tsetPlacement \n"

    ."\tMovement \n"
    ."\t\tmove \n"
    ."\t\tmoveContainer \n"
    ."\t\tputIntoContainer \n"
    ."\t\tremoveFromContainer \n"

    ."\tInventory \n"
    ."\t\tincrementStockQty \n"
    ."\t\tdecrementStockQty \n"
    ."\t\tdeleteStock \n"
    ."\t\tsetItemCondition \n"
    ."\t\tmarkItemSold \n"
    ."\t\tarchiveItem \n"
    ."\t\treturnItem \n"

    ."\tQuery \n"
    ."\t\tgetAllLocation \n"
    ."\t\tgetAllCar \n"
    ."\t\tgetLocationContent \n"
    ."\t\tgetContainerContent \n"
    ."\t\tfindPhysicalTag \n"
    ."\t\tfindStock \n" 
    ."\t\tfindByTag \n"

    ."\tAudit \n"
    ."\t\tsetOwnerPermissions \n"
    ."\t\tdeleteOwner \n"
    ."\t\tgetHistory \n"
    ."\t\tgetSales \n"
);

try{
    $call = $argv[1]??null;
    $storage->$call($argv[2], $argv[3]??null, $argv[4]??null, $argv[5]??null);
}catch(\RuntimeException $e) {
    echo $e->getMessage()."\n";
}