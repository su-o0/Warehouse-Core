<?php 
namespace WarehouseCore\Api\Topology\StorageSlot;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\StorageSlotService;

final class RegisterStorageSlotApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private StorageSlotService $storage_slot_service
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

        return $this->storage_slot_service->registerStorageSlot(
            rack: $rack
        );
    }
}