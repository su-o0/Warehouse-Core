<?php 
namespace WarehouseCore\Output\Provider\Shell;

use WarehouseCore\Contract\Renderer;
use WarehouseCore\Payload\Enum\UserStatusEnum;
use WarehouseCore\Payload\Result\ListUserResult;

final class ListUserRender implements Renderer {
    public function supports(object $result): bool {
        return $result instanceof ListUserResult;
    }

    public function render(object $result): string {
        $users = $result->list;

        $output = "Users:\n";
        foreach ($users as $user) {
            $output .= "  ID: {$user->id}\n";

            if ($user->name !== null) {
                $output .= "  NAME: {$user->name}\n";
            }

            if ($user->role !== null) {
                $output .= "  ROLE: {$user->role->value}\n";
            }

            $output .= "  STATUS: {$user->status->value}\n";

            if ($user->status == UserStatusEnum::Processing) {
                $output .= "  STEP:\n";
                $output .= "    NAMED: " . ($user->step->named ? 'true' : 'false') . "\n";
                $output .= "    ASSIGN ROLE: " . ($user->step->assign_role ? 'true' : 'false') . "\n";
                $output .= "    IDENTIFIED: " . ($user->step->identified ? 'true' : 'false') . "\n\n";
            }
            else {
                $output .= "\n";
            }
        }
        return $output;
    }
}