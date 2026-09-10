<?php
require 'vendor/autoload.php';
use WarehouseCore\Facade\ShellFacade;
use WarehouseCore\Shell\Shell;

$warehouse = ShellFacade::create();

$shell = new Shell($warehouse);
$shell->run();