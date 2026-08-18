<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Payload\Entity\RoleEntity;
use WarehouseCore\Payload\Entity\UserEntity;
use WarehouseCore\Payload\Enum\ProviderNameEnum;

final readonly class SessionDTO {
    public function __construct(
        public UserEntity $user,
        public RoleEntity $role,
        public ProviderNameEnum $provider
    ) { }  
}