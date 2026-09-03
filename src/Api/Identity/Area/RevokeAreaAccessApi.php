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
        try {
            $user = $this->get_service->getUser(
                $request->first_id
            );
        } catch (DomainException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
    
        return $this->area_service->revokeAreaAccess(
            area_id: $request->second_id,
            user_id: $user->id
        );
    }
}