<?php
use SuO0\StorageApi\StorageApi;
require 'vendor/autoload.php';
$config = require 'config.php';
$storage = new StorageApi($config);

if (!isset($argv[1])) 
    die("Storage API:\n".
        "\tAddAddress <Address>\n".
        "\tAddContainer <ContainerId> [Box|Pallet]\n".
        "\tAddPhysicalTag <Id>\n".
        "\tAddPlacement <Address> [Container|Item|Stock] <Id>\n".
        "\tAddItem <PhysicalTag> <Article> ?<IdCar>\n".
        "\tAddStock <ContainerId> <Qcy> ?<Article>\n"
    );

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
    case "AddPhysicalTag":
        try {
            $storage->AddPhysicalTag($argv[2]);
        }catch(\RuntimeException $e) {
            echo $e->getMessage()."\n";
        }
        break;
    case "AddPlacement":
        try {
            $storage->AddPlacement($argv[2], $argv[3], $argv[4]);
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
    case "AddItem":
        try {
            $storage->AddItem($argv[2], $argv[3] );
        }catch(\RuntimeException $e) {
            echo $e->getMessage()."\n";
        }
        break;
    default: 
        break;
}
