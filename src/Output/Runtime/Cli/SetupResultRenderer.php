<?php 
namespace WarehouseCore\Output\Runtime\Cli;

use WarehouseCore\Output\Contracts\OutputRenderer;
use WarehouseCore\Payload\Result\SetupResult;

final class SetupResultRenderer implements OutputRenderer {
    public function supports(object $result): bool {
        return $result instanceof SetupResult;
    }

    public function render(object $result): string {
        return $result->success
            ? "Created"
            : "Error: {$result->message}";
    }
}