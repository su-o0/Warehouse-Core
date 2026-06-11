<?php
namespace WarehouseCore\Output;

use WarehouseCore\Output\Dispatcher\OutputDispatcher;

final class Output {
    public function __construct(
        private OutputDispatcher $dispatcher
    ) {}

    public function render(object $result): mixed
    {
        return $this->dispatcher->render($result);
    }
}