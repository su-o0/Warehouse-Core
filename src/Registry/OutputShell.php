<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Output\Output;
use WarehouseCore\Output\Dispatcher\OutputDispatcher;
use WarehouseCore\Output\Runtime\Cli\GetLocationRender;
use WarehouseCore\Output\Runtime\Cli\ListLocationsRender;
use WarehouseCore\Output\Runtime\Cli\ServiceRenderer;

final class OutputShell {
    public static function create(): Output {
        return new Output(
            new OutputDispatcher([
                new ListLocationsRender(),
                new GetLocationRender(),
                new ServiceRenderer(),
            ])
        );
    }
}