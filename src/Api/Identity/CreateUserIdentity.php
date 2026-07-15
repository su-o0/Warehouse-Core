<?php
namespace WarehouseCore\Api\Identity;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Service\Identity\UserIdentityService;
use WarehouseCore\Service\Query\FindService;

final class CreateUserIdentity {
    public function __construct(
        public string $api_name,
        private FindService $find,
        private UserIdentityService $user_identity
    ) { }

    public function handle(
        int $user_id, 
        ProviderType $provider,
        string $external_id
    ): ServiceResult {
        $result = $this->find->findUserById(
            $user_id
        );

        if (!$result->success) {
            return $result;
        }

        $result = $this->find->findUserIdentity(
            $provider,
            $external_id
        );

        if($result->success){
            return new ServiceResult(
                success: false,
                message: DomainException::USER_IDENTITY_EXISTS()->getMessage()
            );
        }

        return $this->user_identity->create(
            $user_id,
            $provider,
            $external_id
        );
    }
}