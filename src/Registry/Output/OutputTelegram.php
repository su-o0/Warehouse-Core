<?php
namespace WarehouseCore\Registry\Output;

use WarehouseCore\Output\Output;
use WarehouseCore\Output\Dispatcher\OutputDispatcher;
use WarehouseCore\Output\Runtime\Telegram\AddUserRenderer;

final class OutputTelegram {
    public static function create(): Output {
        return new Output(
            new OutputDispatcher([
                new AddUserRenderer(),
            ])
        );
    }
}