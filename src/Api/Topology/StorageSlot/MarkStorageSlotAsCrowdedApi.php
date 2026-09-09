<?php 
namespace WarehouseCore\Api\Topology\StorageSlot;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\Request\EntityRecordRequest;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\StorageSlotService;

final class MarkStorageSlotAsCrowdedApi {
    public function __construct(
        public string $api_name,
        private GetService $get_service,
        private FindService $find_service,
        private StorageSlotService $storage_slot_service
    ) { }

    public function handle(
        EntityRecordRequest $request
    ): ApiResult {
        $result = $this->get_service->getRack(
            $request->id
        );

        if (!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        $result = $this->find_service->findStorageSlotByRackIdAndShelfLevel(
            $rack,
            $request->record_id
        );

        if (!$result->success) {
            return $result;
        }

        $storage_slot = $result->entity;
        
        return $this->storage_slot_service->markStorageSlotAsCrowded(
            rack: $rack,
            storage_slot: $storage_slot
        );
    }
}