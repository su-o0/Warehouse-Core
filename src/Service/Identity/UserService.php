<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserRepository;

use WarehouseCore\Exception\DomainException;

use WarehouseCore\Payload\DTO\UserEntity;

use WarehouseCore\Payload\Result\SetupResult;

final class UserService {
    public function __construct(
        private UserRepository $user_repository,
    ) { }
    
    public function create(
        string $name,
        string $role
       ): SetupResult {
        $user = $this->user_repository->findByName($name);
        
        if($user !== null) {
            return new SetupResult(
                success: false,
                message: DomainException::USER_ALREADY_EXISTS()->getMessage()
            );
        }
        

        $this->user_repository->add(
            $name,
            $role
        );

        return new SetupResult(
            success: true
        );
    }
}