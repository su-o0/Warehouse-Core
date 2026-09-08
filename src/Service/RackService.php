<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Enum\RackTypeEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\VO\RackNameVO;
use WarehouseCore\Repository\Catalog\RackNameRepository;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Processing\RackProcessingStepRepository;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Security\Lifecycle;
use WarehouseCore\Transaction\Rack\AddRackNameTransaction;
use WarehouseCore\Transaction\Rack\PopulateRackTransaction;
use WarehouseCore\Transaction\Rack\SetPrimaryRackNameTransaction;

final class RackService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private RackRepository $rack_repository,
        private RackNameRepository $rack_name_repository,
        private RackProcessingStepRepository $rack_processing_step_repository,
        private PopulateRackTransaction $populate_rack_transaction,
        private AddRackNameTransaction $add_rack_name_transaction,
        private SetPrimaryRackNameTransaction $set_primary_rack_name_transaction
    ) { }

    private function changeStatus(
        int $id,
        RackStatusEnum $status
    ): ServiceResult {
        try {
            $this->rack_repository->updateStatus(
                $id,
                $status->value
            );
        }catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }

    public function populateRack(
        RackEntity $rack,
        int $count
    ): ServiceResult {
        if (!$this->authorization->canPopulateRack()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canPopulateRack($rack)) {
            return ServiceResult::failure(
                ErrorMessage::RACK_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
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
            rack: $rack,
            count: $count,
            user_id: $this->authorization->getUserId(),
        );
    }
    
    public function addRackName(
        RackEntity $rack,
        string $name
    ) {
        if (!$this->authorization->canAddRackName()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canAddRackName($rack)) {
            return ServiceResult::failure(
                ErrorMessage::RACK_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        } 

        return $this->add_rack_name_transaction->handle(
            rack_id: $rack->id,
            value: $name,
            user_id: $this->authorization->getUserId()
        );
    }

    public function setPrimaryRackName(
        RackEntity $rack,
        RackNameVO $rack_name 
    ) {
        if (!$this->authorization->canSetPrimaryRackName()) {
            throw ServiceException::FORBIDDEN();
        }
        
        if (!Lifecycle::canSetPrimaryRackName($rack)) {
            return ServiceResult::failure(
                ErrorMessage::RACK_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        } 

        if ($rack->id != $rack_name->rack_id) {
            return ServiceResult::failure(
                ErrorMessage::AREA_NAME_NOT_FOUND
            );
        }

        if ($rack_name->is_primary){
            return ServiceResult::failure(
                ErrorMessage::AREA_NAME_ALREADY_PRIMARY
            );
        }

        return $this->set_primary_rack_name_transaction->handle(
            $rack_name->record_id,
            $rack_name->rack_id
        );
    }

    public function removeRackName(
        RackEntity $rack
    ) {
        if (!$this->authorization->canRemoveRackName()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canSetPrimaryRackName($rack)) {
            return ServiceResult::failure(
                ErrorMessage::RACK_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        } 

        $rack_name = $this->rack_name_repository->findPrimaryByrackId(
            $rack->id
        );

        if ($rack_name === null) {
            return ServiceResult::failure(
                ErrorMessage::RACK_NAME_NOT_FOUND
            );
        }   

        try {
            $this->rack_name_repository->updatePrimary(
                record_id: $rack_name->record_id,
                is_primary: false
            );
        } catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }
    
    public function registerRack(
        RackTypeEnum $rack_type
    ): ServiceResult {
        if (!$this->authorization->canRegisterRack()) {
            throw ServiceException::FORBIDDEN();
        }

        try {
            $this->rack_repository->add(
                type: $rack_type->value,
                user_id: $this->authorization->getUserId()
            );
        }catch(RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }
       
        return new ServiceResult(
            success: true
        );
    }

    public function activateRack(
        RackEntity $rack
    ): ServiceResult {
        if (!$this->authorization->canActivateRack()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canActivateRack($rack)) {
            return ServiceResult::failure(
                ErrorMessage::RACK_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
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

        return $this->changeStatus(
            $rack->id,
            RackStatusEnum::Active
        );
    } 

    public function markRackAsCrowded(
        RackEntity $rack
    ): ServiceResult {
        if (!$this->authorization->canMarkRackAsCrowded()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canMarkRackAsCrowded($rack)) {
            return ServiceResult::failure(
                ErrorMessage::RACK_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        }   

        return $this->changeStatus(
            $rack->id,
            RackStatusEnum::Crowded
        );
    }

    public function archiveRack(
        RackEntity $rack
    ) {
        if (!$this->authorization->canArchiveRack()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canArchiveRack($rack)) {
            return ServiceResult::failure(
                ErrorMessage::RACK_OPERATION_NOT_ALLOWED_IN_CURRENT_STATE
            );
        } 
        
        return $this->changeStatus(
            $rack->id,
            RackStatusEnum::Archived
        );
    }
}