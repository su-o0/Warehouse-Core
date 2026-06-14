<?php
namespace WarehouseCore\Service\Setup;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;

use WarehouseCore\Payload\Result\SetupResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\DTO\UserEntity;

class AddOwnerService {
    public function __construct(
        private UserRepository $user_repository,
        private OwnerRepository $owner_repository
    ) {}

    public function execute(
        string $name, 
        string $user_id, 
    ): SetupResult {   

        $user_entity = $this->user_repository->findByName($name);
        if($user_entity !== null)
            return new SetupResult(
                success: false,
                message: DomainException::USER_NOT_FOUND()->getMessage()
            );

        try {
            $this->owner_repository->add(
                $name, 
                $user_id
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
