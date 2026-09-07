<?php
namespace WarehouseCore\Api\Identity\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Request\EntityEntityRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\Query\GetService;

final class RevokeAreaAccessApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service,
        private GetService $get_service
    ) { }

    public function handle(
        EntityEntityRequest $request
    ): ApiResult {
        $result = $this->get_service->getUser(
            user_id: $request->first_id
        );

        if (!$result->success) {
            return $result;
        }

        $user = $result->entity;

        $result = $this->get_service->getArea(
            area_id: $request->second_id
        );

        if (!$result->success) {
            return $result;
        }
    
        return $this->area_service->revokeAreaAccess(
            area: $result->entity,
            user: $user
        );
    }
}