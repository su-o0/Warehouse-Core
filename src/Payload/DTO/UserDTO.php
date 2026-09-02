<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Payload\Enum\RoleNameEnum;

final readonly class UserDTO {
    public function __construct(
        public int $id,
        public ?RoleNameEnum $role = null,
        public ?string $name = null,
        public mixed $status,
        public UserStageDTO $step
    ) { }  
}