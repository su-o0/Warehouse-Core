<?php
namespace WarehouseCore\Api\User\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;

final class SetPrimaryUserNameApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private FindService $find_service,
        private UserService $user_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getUser(
            $parameter->user_id
        );

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;

        $result = $this->find_service->findAreaNameByRecordId(
            $parameter->record_id
        );

        if (!$result->success) {
            return $result;
        }

        $user_name = $result->entity;

        return $this->user_service->setPrimaryUserName(
            user: $user,
            user_name: $user_name
        );
    }
}