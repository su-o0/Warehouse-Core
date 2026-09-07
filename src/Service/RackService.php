<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\RackNameRepository;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Processing\RackProcessingStepRepository;
use WarehouseCore\Repository\Topology\RackPlacementRepository;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Transaction\Rack\PopulateRackTransaction;

final class RackService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private RackRepository $rack_repository,
        private RackNameRepository $rack_name_repository,
        private RackPlacementRepository $rack_placement_repository,
        private RackProcessingStepRepository $rack_processing_step_repository,
        private PopulateRackTransaction $populate_rack_transaction
    ) { }

    private function existsRack(
        int $id
    ): ServiceResult {
        try { 
            $result = $this->rack_repository->getById($id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::RACK_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    private function existsRackName(
        int $record_id
    ): ServiceResult {
        try { 
            $result = $this->rack_name_repository->findByRecordId($record_id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::RACK_NAME_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    public function registerRack(): ServiceResult {
        if (!$this->authorization->canRegisterRack()) {
            throw ServiceException::FORBIDDEN();
        }

        $this->rack_repository->add(
            user_id: $this->authorization->getUserId()
        );

        return new ServiceResult(
            success: true
        );
    }

    public function populateRack(
        int $rack_id,
        int $count
    ): ServiceResult {
        if (!$this->authorization->canPopulateRack()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsRack($rack_id);

        if(!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        if ($rack->status !== RackStatusEnum::Registered) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::RACK_INVALID_STATUS_TRANSITION
            );
        }   

        $result = $this->rack_processing_step_repository->findByRackIdAndStage(
            rack_id: $rack->id,
            stage: RackProcessingStepStageEnum::Populate->value
        );

        if($result !== null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::RACK_PROCESSING_STEP_ALREADY_EXISTS
            );
        }

        return $this->populate_rack_transaction->handle(
            rack_id: $rack->id,
            count: $count,
            user_id: $this->authorization->getUserId(),
        );
    }
    
    public function activateRack(
        int $rack_id
    ) {
        if (!$this->authorization->canActivateRack()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsRack($rack_id);

        if(!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        if (!in_array(
            $rack->status,
            [
                RackStatusEnum::Processing,
                RackStatusEnum::Archived
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::RACK_INVALID_STATUS_TRANSITION
            );
        }   

        $result = $this->rack_processing_step_repository->findByRackIdAndStage(
            rack_id: $rack->id,
            stage: RackProcessingStepStageEnum::Populate->value
        );

        if($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::RACK_PROCESSING_STEP_NOT_FOUND
            );
        }

        try {
            $this->rack_repository->updateStatus(
                $rack->id,
                RackStatusEnum::Active->value
            );
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true
        );
    } 

    public function markRackAsCrowded() {
        if (!$this->authorization->canMarkRackAsCrowded()) {
            throw ServiceException::FORBIDDEN();
        }

    }

    public function archiveRack() {
        if (!$this->authorization->canArchiveRack()) {
            throw ServiceException::FORBIDDEN();
        }

    }

    public function addRackName() {
        if (!$this->authorization->canAddRackName()) {
            throw ServiceException::FORBIDDEN();
        }

    }

    public function setPrimaryRackName() {
        if (!$this->authorization->canSetPrimaryRackName()) {
            throw ServiceException::FORBIDDEN();
        }
    }

    public function removeRackName() {
        if (!$this->authorization->canRemoveRackName()) {
            throw ServiceException::FORBIDDEN();
        }
    }
}