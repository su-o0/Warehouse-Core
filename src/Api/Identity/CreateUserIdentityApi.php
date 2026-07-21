<?php
namespace WarehouseCore\Api\Identity;

use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Request\CreateUserIdentityRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Identity\UserIdentityService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;

final class CreateUserIdentityApi {
    public function __construct(
        public string $api_name,
        private GetService $get,
        private FindService $find,
        private UserIdentityService $user_identity
    ) { }

    public function handle(
        CreateUserIdentityRequest $request
    ): ServiceResult {
        $result = $this->get->getUser(
            $request->user_id
        );

        $result = $this->find->findUserIdentity(
            $request->provider,
            $request->external_id
        );

        if(!$result->success) {
            return $result;
        }

        if($result->entity === null ){
            return new ServiceResult(
                success: false,
                message: ServiceException::USER_IDENTITY_NOT_FOUND()->getMessage()
            );
        }

        return $this->user_identity->create(
            $request->user_id,
            $request->provider,
            $request->external_id
        );
    }
}