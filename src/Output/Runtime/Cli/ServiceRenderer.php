<?php 
namespace WarehouseCore\Output\Runtime\Cli;

use WarehouseCore\Contract\OutputRenderer;
use WarehouseCore\Payload\Result\ServiceResult;

final class ServiceRenderer implements OutputRenderer {
    public function supports(object $result): bool {
        return $result instanceof ServiceResult;
    }

    public function render(object $result): string {
        return $result->success
            ? "Success\n"
            : "Error: {$result->message}\n";
    }
}