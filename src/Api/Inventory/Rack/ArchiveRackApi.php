<?php 
namespace WarehouseCore\Api\Inventory\Rack;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\RackService;

final class ArchiveRackApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private RackService $rack_service
    ) { }

    public function handle(
        EntityRequest $request
    ): ApiResult {
        $result = $this->get_service->getRack(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        return $this->rack_service->archiveRack(
            rack: $rack,
        );
    }
}