<?php
namespace WarehouseCore\Output\Runtime\Cli;

use WarehouseCore\Output\Dispatcher\OutputDispatcher;

final class CliOutput
{
    public function __construct(
        private OutputDispatcher $dispatcher
    ) {}

    public function render(object $result): string
    {
        return $this->dispatcher->render($result, 'cli');
    }
}