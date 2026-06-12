<?php
namespace WarehouseCore\Registry\Output;

use WarehouseCore\Output\Output;
use WarehouseCore\Output\Dispatcher\OutputDispatcher;
use WarehouseCore\Output\Runtime\Cli\AddUserRenderer;

final class OutputCli {
    public static function create(): Output {
        return new Output(
            new OutputDispatcher([
                new AddUserRenderer(),
            ])
        );
    }
}