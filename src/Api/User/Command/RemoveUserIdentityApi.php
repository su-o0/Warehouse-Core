<?php
namespace WarehouseCore\Api\User\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Query\GetService;

final class RemoveUserIdentityApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private UserService $user_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getProvider(
            $parameter->provider
        );

        if (!$result->success) {
            return $result;
        }

        $provider = $result->entity->name;

        $result = $this->get_service->getUser(
            $parameter->user_id
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