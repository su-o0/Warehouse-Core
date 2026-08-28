<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Enum\ProviderNameEnum;
use WarehouseCore\Payload\Enum\RoleNameEnum;

final readonly class SessionDTO {
    public function __construct(
        public UserEntity $user,
        public RoleNameEnum $role,
        public ProviderNameEnum $provider
    ) { }  
}