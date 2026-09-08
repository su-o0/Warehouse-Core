<?php
namespace WarehouseCore\Api\Catalog\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRecordRequest;
use WarehouseCore\Service\Identity\UserService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;

final class SetPrimaryUserNameApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private FindService $find_service,
        private UserService $user_service
    ) { }

    public function handle(
        EntityRecordRequest $request
    ): ApiResult {
        $result = $this->get_service->getUser(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;

        $result = $this->find_service->findAreaNameByRecordId(
            $request->id
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