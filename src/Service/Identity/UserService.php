<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Security\Authorization;

final class UserService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private UserRepository $user_repository,
    ) { }
    
    public function create(
        string $name,
        int $role_id
    ): ServiceResult {
    
        if(!$this->authorization->canCreateUser()){
            return new ServiceResult(
                success: false,
                message: ServiceException::Forbidden()->getMessage()
            );
        }

        try {
            $id = $this->user_repository->add(
                $name,
                $role_id
            );
        } catch(RepositoryException $e){
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true,
            entity: $id
        );
    }
}