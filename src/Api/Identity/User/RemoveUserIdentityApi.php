<?php
namespace WarehouseCore\Api\Identity\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Map\ProviderNameMapper;
use WarehouseCore\Payload\Request\UserIdentityRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Identity\UserService;

final class RemoveUserIdentityApi {
    public function __construct(
        public string $api_name,
        private UserService $user_service
    ) { }

    public function handle(
        UserIdentityRequest $request
    ): ApiResult {
        try {
            $provider = ProviderNameMapper::fromString(
                $request->provider
            );
        } catch (DomainException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return $this->user_service->removeUserIdentity(
            user_id: $request->user_id,
            provider: $provider
        );
    }
}