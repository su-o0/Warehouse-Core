<?php
namespace WarehouseCore\Api\Identity\Area;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\AreaAccessRequest;
use WarehouseCore\Service\AreaService;
use WarehouseCore\Service\Query\GetService;

final class RevokeAreaAccessApi {
    public function __construct(
        public string $api_name,
        private AreaService $area_service,
        private GetService $get_service
    ) { }

    public function handle(
        AreaAccessRequest $request
    ): ApiResult {
        $user = $this->get_service->getUser(
            $request->user_id
        );

        return $this->area_service->revokeAreaAccess(
            $request->area_id,
            $user->id
        );
    }
}