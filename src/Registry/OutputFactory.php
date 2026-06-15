<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Output\Output;

final class OutputFactory {
    public static function cli(): Output {
        return OutputCli::create();
    }
}