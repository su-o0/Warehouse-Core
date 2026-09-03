<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Output\Output;
use WarehouseCore\Output\Dispatcher;
use WarehouseCore\Output\Provider\Shell\ListEntityNamesRender;
use WarehouseCore\Output\Provider\Shell\ListStructureRender;
use WarehouseCore\Output\Provider\Shell\ListUserIdentitiesRender;
use WarehouseCore\Output\Provider\Shell\ListUserRender;
use WarehouseCore\Output\Provider\Shell\ServiceRenderer;

final class ShellOutputRegistry {
    public static function create(): Output {
        return new Output(
            new Dispatcher([
                new ListUserIdentitiesRender(),
                new ListUserRender(),
                new ListEntityNamesRender(),
                new ListStructureRender(),
                new ServiceRenderer(),
            ])
        );
    }
}