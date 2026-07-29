<?php 
namespace WarehouseCore\Output\Runtime\Cli;

use WarehouseCore\Contract\Renderer;
use WarehouseCore\Payload\Result\ListLocationsResult;

final class ListLocationsRender implements Renderer {
    public function supports(object $result): bool {
        return $result instanceof ListLocationsResult;
    }

    public function render(object $result): string {
        $locations = $result->list;

        $result = '';
        foreach($locations as $location) {
            $result .= implode("\n", [
                "Location",
                "  ID: {$location->id}",
                "  Name: {$location->address->getValue()}",
                "  Status: {$location->status->value}",
                ""
            ]);
        }
        return $result;
    }
}