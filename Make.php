<?php
use WarehouseCore\WarehouseCore;
require 'vendor/autoload.php';

$config = require 'config.php';
$storage = new WarehouseCore($config);