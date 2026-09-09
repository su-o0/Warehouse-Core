<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Entity\StorageSlotEntity;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\RackTypeEnum;
use WarehouseCore\Payload\Enum\StorageSlotStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Processing\RackProcessingStepRepository;
use WarehouseCore\Repository\Topology\StorageSlotRepository;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Security\Lifecycle;
use WarehouseCore\Transaction\StorageSlot\RegisterStorageSlotTransaction;
use WarehouseCore\Transaction\StorageSlot\RemoveStorageSlotTransaction;

final class StorageSlotService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private StorageSlotRepository $storage_slot_repository,
        private RackProcessingStepRepository $rack_processing_step_repository,
        private RegisterStorageSlotTransaction $register_storage_slot_transaction,
        private RemoveStorageSlotTransaction $remove_storage_slot_transaction,
    ) { }

    public function registerStorageSlot(
        RackEntity $rack
    ): ServiceResult {
        if (!$this->authorization->canRegisterStorageSlot()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canRegisterStorageSlot($rack)) {
            throw ServiceException::FORBIDDEN();
        }

        if ($rack->type !== RackTypeEnum::StorageSlot) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->rack_processing_step_repository->findByRackIdAndStage(
            rack_id: $rack->id,
            stage: RackProcessingStepStageEnum::Populate->value
        );

        if($result === null) {
            return ServiceResult::failure(
                ErrorMessage::RACK_PROCESSING_STEP_NOT_FOUND
            );
        }

        $result = $this->storage_slot_repository->findLastPositionByRackId(
            rack_id: $rack->id
        );

        if ($result === null) {
            return ServiceResult::failure(
                ErrorMessage::SHELF_NOT_FOUND
            );
        }

        $slot_position = $result->slot_position + 1;
        
        return $this->register_storage_slot_transaction->handle(
            rack: $rack,
            slot_position: $slot_position,
            user_id: $this->authorization->getUserId()
        );
    }

    public function markStorageSlotAsCrowded(
        RackEntity $rack,
        StorageSlotEntity $storage_slot
    ): ServiceResult {
        if (!$this->authorization->canMarkStorageSlotAsCrowded()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canMarkStorageSlotAsCrowded($rack, $storage_slot)) {
            throw ServiceException::FORBIDDEN();
        }

        try {
            $this->storage_slot_repository->updateStatus(
                id: $storage_slot->id,
                status: StorageSlotStatusEnum::Crowded->value
            );
        } catch (RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }

    public function removeStorageSlot(
        RackEntity $rack,
        StorageSlotEntity $storage_slot
    ): ServiceResult {
        if (!$this->authorization->canRemoveStorageSlot()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canRemoveStorageSlot($rack, $storage_slot)) {
            throw ServiceException::FORBIDDEN();
        }

        return $this->remove_storage_slot_transaction->handle(
            rack: $rack,
            storage_slot: $storage_slot
        );
    }
}