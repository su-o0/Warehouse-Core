<?php 
namespace WarehouseCore\Output\Provider\Shell;

use WarehouseCore\Contract\Renderer;
use WarehouseCore\Payload\Result\ListEntityNamesResult;

final class ListEntityNamesRender implements Renderer {
    public function supports(object $result): bool {
        return $result instanceof ListEntityNamesResult;
    }

    public function render(object $result): string {
        $entities = $result->list;


        $output = "Entity: {$result->entity_name} \n";
        $output .= "ID: {$result->entity_id} \n";
        foreach ($entities as $entity) {
            $output .= "  RECORD ID: {$entity->record_id}\n";

            if ($entity->is_primary) {
                $output .= "  PRIMARY NAME: {$entity->name}\n\n";
            }
            else {
                $output .= "  NAME: {$entity->name}\n\n";
            }
        }
        return $output;
    }
}