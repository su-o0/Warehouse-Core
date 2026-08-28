<?php 
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Payload\DTO\SessionDTO;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Payload\Enum\ProviderNameEnum;
use WarehouseCore\Repository\Identity\ProviderRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\UserRepository;

final class AuthenticationService {
    public function __construct(
        public string $service_name,
        private RoleRepository $role_repository,
        private ProviderRepository $provider_repository,
        private UserRepository $user_repository,
        private UserIdentityRepository $user_identity_repository
    ) { }

    public function authenticate(
        ProviderNameEnum $provider_name,
        string $external_id
    ): ServiceResult {

        $provider = $this->provider_repository->getByName(
            $provider_name->value
        );

        if ($provider === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::PROVIDER_NOT_FOUND
            );
        }

        $user_identity = $this->user_identity_repository->findByProviderAndExternalId(
            $provider->name->value, 
            $external_id
        );
        
        if ($user_identity === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AUTHENTICATION_FAILED
            );
        }
        
        $user = $this->user_repository->getById($user_identity->user_id);

        if ($user === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::USER_NOT_FOUND
            ); 
        }

        $role = $this->role_repository->getByName(
            $user->role->value
        );

        if ($role === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ROLE_NOT_FOUND
            ); 
        }

        return new ServiceResult(
            success: true,
            entity: new SessionDTO(
                user: $user,
                role: $role->name,
                provider: $provider->name
            )
        );
    }
}