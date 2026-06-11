<?php
namespace WarehouseCore\Output\Registry;

use WarehouseCore\Output\Dispatcher\OutputDispatcher;
use WarehouseCore\Output\Output;
use WarehouseCore\Output\Runtime\Cli\AddUserRenderer;

final class OutputFactory {
    public static function cli(): Output {
        return new Output(
            new OutputDispatcher([
                new AddUserRenderer(),
            ])
        );
    }
}