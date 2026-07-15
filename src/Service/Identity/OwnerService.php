<?php 
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\UserRepository;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\DTO\UserEntity;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Security\Authorization;

final class OwnerService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private OwnerRepository $owner_repository,
        private UserRepository $user_repository
    ) { }

    public function create(
        string $name, 
        string $user_id, 
    ): ServiceResult {   
        $user_entity = $this->user_repository->findByName($name);
        if($user_entity !== null)
            return new ServiceResult(
                success: false,
                message: DomainException::USER_NOT_FOUND()->getMessage()
            );

        try {
            $this->owner_repository->add(
                $name, 
                $user_id
            );
        }catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true
        );
    }
}