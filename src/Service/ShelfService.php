<?php 
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Entity\ShelfEntity;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Enum\RackTypeEnum;
use WarehouseCore\Payload\Enum\ShelfStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Processing\RackProcessingStepRepository;
use WarehouseCore\Repository\Topology\ShelfRepository;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Security\Lifecycle;
use WarehouseCore\Transaction\Shelf\RegisterShelfTransaction;
use WarehouseCore\Transaction\Shelf\RemoveShelfTransaction;

final class ShelfService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ShelfRepository $shelf_repository,
        private RackProcessingStepRepository $rack_processing_step_repository,
        private RegisterShelfTransaction $register_shelf_transaction,
        private RemoveShelfTransaction $remove_shelf_transaction,
    ) { }

    public function registerShelf(
        RackEntity $rack
    ): ServiceResult {
        if (!$this->authorization->canRegisterShelf()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canRegisterShelf($rack)) {
            throw ServiceException::FORBIDDEN();
        }

        if ($rack->type !== RackTypeEnum::Shelf) {
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

        $result = $this->shelf_repository->findLastLevelByRackId(
            rack_id: $rack->id
        );

        if ($result === null) {
            return ServiceResult::failure(
                ErrorMessage::SHELF_NOT_FOUND
            );
        }

        $shelf_level = $result->shelf_level + 1;
        
        return $this->register_shelf_transaction->handle(
            rack: $rack,
            shelf_level: $shelf_level,
            user_id: $this->authorization->getUserId()
        );
    }

    public function markShelfAsCrowded(
        RackEntity $rack,
        ShelfEntity $shelf
    ): ServiceResult {
        if (!$this->authorization->canMarkShelfAsCrowded()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canMarkShelfAsCrowded($rack, $shelf)) {
            throw ServiceException::FORBIDDEN();
        }

        try {
            $this->shelf_repository->updateStatus(
                id: $shelf->id,
                status: ShelfStatusEnum::Crowded->value
            );
        } catch (RepositoryException $e) {
            return ServiceResult::failure(
                $e->getMessage()
            );
        }

        return ServiceResult::success();
    }

    public function removeShelf(
        RackEntity $rack,
        ShelfEntity $shelf
    ): ServiceResult {
        if (!$this->authorization->canRemoveShelf()) {
            throw ServiceException::FORBIDDEN();
        }

        if (!Lifecycle::canRemoveShelf($shelf)) {
            throw ServiceException::FORBIDDEN();
        }

        return $this->remove_shelf_transaction->handle(
            rack: $rack,
            shelf: $shelf,
        );
    }
}