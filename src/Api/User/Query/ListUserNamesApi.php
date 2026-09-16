<?php
namespace WarehouseCore\Api\User\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Query\ListService;

final class ListUserNamesApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private ListService $list_service
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

        return $this->list_service->listUserNames(
            user: $result->entity
        );
    }
}