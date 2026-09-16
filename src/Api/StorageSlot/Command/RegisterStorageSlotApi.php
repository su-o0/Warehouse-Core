<?php 
namespace WarehouseCore\Api\StorageSlot\Command;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Payload\DTO\ApiConfigDTO;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\StorageSlotService;

final class RegisterStorageSlotApi {
    public function __construct(
        public ApiConfigDTO $config,
        private GetService $get_service,
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

        return $this->storage_slot_service->registerStorageSlot(
            rack: $result->entity
        );
    }
}