<?php 
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\DTO\Session;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;

use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Repository\Identity\RoleRepository;

final class AuthenticationService {
    public function __construct(
        public string $service_name,
        private RoleRepository $role_repository,
        private UserRepository $user_repository,
        private UserIdentityRepository $user_identity_repository
    ) { }

    public function authenticate(
        ProviderType $provider,
        string $external_id
    ): ServiceResult {
        $user_identity = $this->user_identity_repository->findByProviderAndId(
            $provider->name, 
            $external_id
        );
        
        if ($user_identity === null) {
            return new ServiceResult(
                success: false,
                message: ServiceException::AUTHENTICATION_FAILED()->getMessage()
            );
        }
        
        $user = $this->user_repository->getById($user_identity->user_id);

        if ($user === null) {
            return new ServiceResult(
                success: false,
                message: DomainException::USER_NOT_FOUND()->getMessage()
            ); 
        }

        $role = $this->role_repository->getById($user->role_id);

        if ($role === null) {
            return new ServiceResult(
                success: false,
                message: DomainException::ROLE_NOT_FOUND()->getMessage()
            ); 
        }

        return new ServiceResult(
            success: true,
            entity: new Session(
                user: $user,
                role: $role,
                provider: $provider 
            )
        );
    }
}