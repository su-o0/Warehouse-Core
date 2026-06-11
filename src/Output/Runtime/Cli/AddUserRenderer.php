<?php 
namespace WarehouseCore\Output\Runtime\Cli;

use WarehouseCore\Output\Contracts\OutputRenderer;
use WarehouseCore\Payload\Result\AddUserResult;

final class AddUserRenderer implements OutputRenderer {
    public function supports(object $result): bool {
        return $result instanceof AddUserResult;
    }

    public function render(object $result): string {
        return $result->success
            ? "User created: {$result->userId}"
            : "Error: {$result->message}";
    }
}