<?php
namespace WarehouseCore\Api\Identity\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Map\ProviderNameMapper;
use WarehouseCore\Payload\Request\UserIdentityRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Query\GetService;

final class RemoveUserIdentityApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private UserService $user_service
    ) { }

    public function handle(
        UserIdentityRequest $request
    ): ApiResult {
        // try {
        //     $provider = ProviderNameMapper::fromString(
        //         $request->provider
        //     );
        // } catch (DomainException $e) {
        //     return new ServiceResult(
        //         success: false,
        //         message: $e->getMessage()
        //     );
        // }

        $result = $this->get_service->getProvider(
            $request->provider
        );

        if (!$result->success) {
            return $result;
        }

        $provider = $result->entity->name;

        $result = $this->get_service->getUser(
            $request->user_id
        );

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;

        return $this->user_service->removeUserIdentity(
            user: $user,
            provider: $provider
        );
    }
}