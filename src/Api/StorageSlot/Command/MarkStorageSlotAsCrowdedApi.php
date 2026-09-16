<?php 
namespace WarehouseCore\Api\StorageSlot\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\StorageSlotService;

final class MarkStorageSlotAsCrowdedApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
        private FindService $find_service,
        private StorageSlotService $storage_slot_service
    ) { }

    public function handle(
        ParameterBag $parameter
    ): ApiResult {
        $result = $this->get_service->getRack(
            $parameter->rack_id
        );

        if (!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        $result = $this->find_service->findStorageSlotByRackIdAndShelfLevel(
            $rack,
            $parameter->record_id
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