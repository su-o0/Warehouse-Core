<?php 
namespace WarehouseCore\Output\Provider\Shell;

use WarehouseCore\Contract\Renderer;
use WarehouseCore\Payload\Result\ListStructureNamesResult;

final class ListStructureNamesRender implements Renderer {
    public function supports(object $result): bool {
        return $result instanceof ListStructureNamesResult;
    }

    public function render(object $result): string {
        $structures = $result->list;

        $output = "Structure: {$result->structure_name}\n";
        foreach ($structures as $structure) {
            $output .= "  RECORD ID: {$structure->record_id}\n";

            if ($structure->is_primary) {
                $output .= "  PRIMARY NAME: {$structure->name}\n\n";
            }
            else {
                $output .= "  NAME: {$structure->name}\n\n";
            }
        }
        return $output;
    }
}