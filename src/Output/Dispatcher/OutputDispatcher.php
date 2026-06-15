<?php
namespace WarehouseCore\Output\Dispatcher;

use RuntimeException;

final class OutputDispatcher {
    public function __construct(
        private array $renderers
    ) {}

    public function render(object $result): mixed {
        foreach ($this->renderers as $renderer) {
            if ($renderer->supports($result)) {
                return $renderer->render($result);
            }
        }

        throw new RuntimeException("No renderer for result");
    }
}