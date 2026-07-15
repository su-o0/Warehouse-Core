<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserIdentityRepository;

use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Security\Authorization;

final class UserIdentityService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private UserIdentityRepository $user_identity_repository
    ) { }

    public function create(
        int $user_id,
        ProviderType $provider,
        string $external_id
    ): ServiceResult {
        if(!$this->authorization->canCreateUserIdentity()) {
             return new ServiceResult(
                success: false,
                message: ServiceException::FORBIDDEN()->getMessage()
            );
        }
       
        try {
            $id = $this->user_identity_repository->add(
                $user_id,
                (string)$provider,
                $external_id
            );
        }catch(RepositoryException $e){
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