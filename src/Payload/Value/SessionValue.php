<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Payload\DTO\RoleEntity;
use WarehouseCore\Payload\DTO\UserEntity;
use WarehouseCore\Payload\Type\ProviderType;

final readonly class SessionValue {
    public function __construct(
        public UserEntity $user,
        public RoleEntity $role,
        public ProviderType $provider
    ) { }  
}