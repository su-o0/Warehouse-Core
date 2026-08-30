<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Output\Output;
use WarehouseCore\Output\Dispatcher;
use WarehouseCore\Output\Provider\Shell\ListStructureNamesRender;
use WarehouseCore\Output\Provider\Shell\ListStructureRender;
use WarehouseCore\Output\Provider\Shell\ServiceRenderer;

final class ShellOutputRegistry {
    public static function create(): Output {
        return new Output(
            new Dispatcher([
                new ListStructureNamesRender(),
                new ListStructureRender(),
                new ServiceRenderer(),
            ])
        );
    }
}