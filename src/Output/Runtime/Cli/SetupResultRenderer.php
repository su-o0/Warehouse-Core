<?php 
namespace WarehouseCore\Output\Runtime\Cli;

use WarehouseCore\Output\Contracts\OutputRenderer;
use WarehouseCore\Payload\Result\ServiceResult;

final class SetupResultRenderer implements OutputRenderer {
    public function supports(object $result): bool {
        return $result instanceof ServiceResult;
    }

    public function render(object $result): string {
        return $result->success
            ? "Created\n"
            : "Error: {$result->message}\n";
    }
}