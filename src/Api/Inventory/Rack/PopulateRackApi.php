<?php 
namespace WarehouseCore\Api\Inventory\Rack;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRecordRequest;
use WarehouseCore\Service\RackService;

final class PopulateRackApi {
    public function __construct(
        public string $api_name,
        private RackService $rack_service
    ) { }

    public function handle(
        EntityRecordRequest $request
    ): ApiResult {
        return $this->rack_service->populateRack(
            rack_id: $request->id,
            count: $request->record_id,
        );
    }
}