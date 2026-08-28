<?php
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\ItemProcessingStage;
use WarehouseCore\Payload\Type\ItemStatus;
use WarehouseCore\Repository\Processing\ItemProcessingStepRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Security\Authorization;

final class ItemService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ItemRepository $item_repository,
        private ItemProcessingStepRepository $item_processing_step_repository,
    ) { }

    public function create(
        int $physical_tag_id, 
        ?int $owner_id,
        ?int $vehicle_id
    ): ServiceResult {
        if(!$this->authorization->canCreateItem()) {
            return new ServiceResult( 
                success: false,
                message: ErrorMessage::AUTHENTICATION_FAILED 
            );
        }

        try {
            $item_id = $this->item_repository->add(
                $this->authorization->user->id,
                $physical_tag_id,
                $owner_id,
                $vehicle_id
            );
            return new ServiceResult(
                success: true,
                entity: $item_id
            );
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
    }

    public function stagePlacement(
        int $item_id,
        array $metadata = []
    ): ServiceResult {
        $metadata = json_encode($metadata);
        try {
            $result = $this->item_processing_step_repository->add(
                $item_id,
                ItemProcessingStage::Placement->value,
                $metadata,
                $this->authorization->user->id
            );
        } catch (RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: $result
        );
    }


    private function changeStatus(
        int $item_id,
        ItemStatus $status
    ): ServiceResult {
        try {
            $result = $this->item_repository->updateStatus(
                $item_id,
                $status->value
            );
        }catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: $result
        );
    }

    public function setProcessing(
        int $item_id
    ): ServiceResult {
        return $this->changeStatus(
            $item_id,
            ItemStatus::Processing
        );
    }

    public function setActive(
        int $item_id
    ): ServiceResult {
        return $this->changeStatus(
            $item_id,
            ItemStatus::Active
        );
    }

    public function setSold(
        int $item_id
    ): ServiceResult {
        return $this->changeStatus(
            $item_id,
            ItemStatus::Sold
        );
    }

    public function setArchived(
        int $item_id
    ): ServiceResult {
        return $this->changeStatus(
            $item_id,
            ItemStatus::Archived
        );
    }

    public function setLost(
        int $item_id
    ): ServiceResult {
        return $this->changeStatus(
            $item_id,
            ItemStatus::Archived
        );
    }
}