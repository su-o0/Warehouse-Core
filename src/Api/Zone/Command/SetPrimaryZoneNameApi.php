<?php
namespace WarehouseCore\Api\Catalog\Zone;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\ZoneService;

final class SetPrimaryZoneNameApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private FindService $find_service,
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

        $zone = $result->entity;

        $result = $this->find_service->findZoneNameByRecordId(
            $parameter->record_id
        );

        if (!$result->success) {
            return $result;
        }

        $zone_name = $result->entity;

        return $this->zone_service->setPrimaryZoneName(
            zone: $zone,
            zone_name: $zone_name
        );
    }
}