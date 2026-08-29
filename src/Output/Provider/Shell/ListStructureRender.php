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

        $result = "Structure: {$result->structure_name}";
        foreach($structures as $structure) {
            $result .= implode("\n", [
                "  Id: {$structure->id}",
                (isset($structure->name))?
                    "  Name: {$structure->name}": 
                    "",
                "  Status: {$structure->status->value}",
                ""
            ]);
        }
        return $result;
    }
}