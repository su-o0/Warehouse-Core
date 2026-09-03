<?php
namespace WarehouseCore\Api\Catalog\User;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRecordRequest;
use WarehouseCore\Service\Identity\UserService;

final class SetPrimaryUserNameApi {
    public function __construct(
        public string $api_name,
        private UserService $user_service
    ) { }

    public function handle(
        EntityRecordRequest $request
    ): ApiResult {
        return $this->user_service->setPrimaryUserName(
            user_id: $request->id,
            record_id: $request->record_id,
        );
    }
}