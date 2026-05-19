<?php
use WarehouseCore\WarehouseCore;
require 'vendor/autoload.php';
$config = require 'config.php';
$storage = new WarehouseCore($config);

if (!isset($argv[1])) 
die(
    "Storage API:\n"
    ."Setup:\n"
    ."\taddLocation <Address> \n"
    ."\taddContainer <Id> <Box|Pallet> \n"
    ."\taddPhysicalTag <Id> \n"
    ."\taddOwner <UserId> <Name> <Admin|Worker|Salesman> \n"
    ."\taddCar <Vin>\n"
    ."\taddItem <Address> <PhysicalTagId> <Article> <?IdCar> \n"
    ."\taddStock <Address> <Qty> <Article> \n"

    ."Placement: \n"
    ."\tsetPlacement <Item|Stock|Container> <Id> <LocationId|ContainerId> \n"

    ."Movement: \n"
    ."\tmove <Item|Stock|Container> <Id> <Address> \n"
    ."\tmoveContainer <ContainerId> <LocationId> \n"
    ."\tputIntoContainer <Item|Stock> <ContainerId> \n"
    ."\tremoveFromContainer <Item|Stock> <ContainerId> \n"

    ."Inventory: \n"
    ."\tincrementStockQty <StockId> <Qty> \n"
    ."\tdecrementStockQty <StockId> <Qty> \n"
    ."\tdeleteStock <StockId> \n"
    ."\tsetItemCondition <PhysicalTagId> <Condition> \n"
    ."\tmarkItemSold <PhysicalTagId> \n"
    ."\tarchiveItem <PhysicalTagId> \n"
    ."\treturnItem <PhysicalTagId>\n"

    ."Query: \n"
    ."\tgetAllLocation \n"
    ."\tgetAllCar \n"
    ."\tgetLocationContent <Address>\n"
    ."\tgetContainerContent <ContainerId> \n"
    ."\tfindPhysicalTag <PhysicalTagId> \n"
    ."\tfindStock <StockId> \n" 
    ."\tfindByTag <Tag> \n"

    ."Audit: \n"
    ."\tsetOwnerPermissions <UserId> <Permissions>\n"
    ."\tgetAllOwner \n"
    ."\tdeleteOwner <UserId> \n"
    ."\tgetHistory \n"
    ."\tgetSales \n"
);

try{
    $call = $argv[1]??null;
    $storage->$call($argv[2], $argv[3]??null, $argv[4]??null, $argv[5]??null);
}catch(\RuntimeException $e) {
    echo $e->getMessage()."\n";
}