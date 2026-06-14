<?php
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Repository\Identity\UserRepository;

use WarehouseCore\Payload\Result\AddUserResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\DTO\UserEntity;
use WarehouseCore\Payload\Result\SetupResult;

final class AddUserService {
    public function __construct(
        private UserRepository $user_repository,
    ) { }

    public function execute(
        UserEntity $user_entity
       ): SetupResult {
        
        $user = $this->user_repository->findByTelegramId($user_entity->telegram_id);
        if($user !== null) 
            return new SetupResult(
                success: false,
                message: DomainException::USER_ALREADY_EXISTS()->getMessage()
            );
            
        try {
            $this->user_repository->add(
                $user_entity->telegram_id, 
                $user_entity->name, 
                $user_entity->role_id
            );
        }catch(RepositoryException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new SetupResult(
            success: true
        );
    }
} 