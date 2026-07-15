<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Payload\Type\ProviderType;

final class Session {
    public function __construct(
        public readonly UserEntity $user,
        public readonly RoleEntity $role,
        public readonly ProviderType $provider
    ) { }  
}