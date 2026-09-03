<?php 
namespace WarehouseCore\Output\Provider\Shell;

use WarehouseCore\Contract\Renderer;
use WarehouseCore\Payload\Result\ListUserIdentitiesResult;

final class ListUserIdentitiesRender implements Renderer {
    public function supports(object $result): bool {
        return $result instanceof ListUserIdentitiesResult;
    }

    public function render(object $result): string {
        $structures = $result->list;

        $output = "User: {$result->user_id} \n";
        foreach ($structures as $structure) {
            $output .= "  RECORD ID: {$structure->record_id}\n";
            $output .= "  PROVIDER: {$structure->provider->value}\n";
            $output .= "  EXTERNAL ID: {$structure->external_id}\n\n";
        }
        return $output;
    }
}