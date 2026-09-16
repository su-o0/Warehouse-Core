<?php
namespace WarehouseCore\Api\Zone\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ZoneService;

final class AddZoneNameApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private ZoneService $zone_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getZone(
            $parameter->zone_id
        );

        if (!$result->success) {
            return $result;
        }

        return $this->zone_service->addZoneName(
            zone: $result->entity,
            name: $parameter->name
        );
    }
}