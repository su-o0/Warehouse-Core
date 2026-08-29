<?php 
namespace WarehouseCore\Output\Provider\Shell;

use WarehouseCore\Contract\Renderer;
use WarehouseCore\Payload\Result\ListStructureResult;

final class ListStructureRender implements Renderer {
    public function supports(object $result): bool {
        return $result instanceof ListStructureResult;
    }

    public function render(object $result): string {
        $structures = $result->list;

        $output = "Structure: {$result->structure_name}\n";
        foreach ($structures as $structure) {
            $output .= "  ID: {$structure->id}\n";

            if ($structure->name !== null) {
                $output .= "  NAME: {$structure->name}\n";
            }

            $output .= "  STATUS: {$structure->status->value}\n\n";
        }
        return $output;
    }
}