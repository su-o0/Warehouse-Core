<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Output\Output;
use WarehouseCore\Output\Dispatcher\OutputDispatcher;
use WarehouseCore\Output\Runtime\Cli\SetupResultRenderer;

final class OutputCli {
    public static function create(): Output {
        return new Output(
            new OutputDispatcher([
                new SetupResultRenderer(),
            ])
        );
    }
}