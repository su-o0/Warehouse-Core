<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserRepository;

use WarehouseCore\Payload\DTO\UserEntity;

use WarehouseCore\Payload\Result\SetupResult;

final class UserService {
    public function __construct(
        private UserRepository $user_repository,
    ) { }
    
    public function create(
        UserEntity $user_entity
       ): SetupResult {
        
        return new SetupResult(
            success: true
        );
    }
}