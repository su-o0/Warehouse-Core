<?php 
namespace WarehouseCore\Output\Runtime\Cli;

use WarehouseCore\Contract\Renderer;
use WarehouseCore\Payload\Result\GetLocationResult;

final class GetLocationRender implements Renderer {
    public function supports(object $result): bool {
        return $result instanceof GetLocationResult;
    }

    public function render(object $result): string {
        $location = $result->entity;

        return implode("\n", [
            "Location",
            "  ID: {$location->id}",
            "  Name: {$location->address->getValue()}",
            "  Status: {$location->status->value}",
            ""
        ]);
    }
}