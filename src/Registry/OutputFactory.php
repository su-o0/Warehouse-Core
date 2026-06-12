<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Output\Output;
use WarehouseCore\Registry\Output\OutputCli;
use WarehouseCore\Registry\Output\OutputTelegram;

final class OutputFactory {
    public static function cli(): Output {
        return OutputCli::create();
    }

    public static function telegram(): Output {
        return OutputTelegram::create();
    }
}