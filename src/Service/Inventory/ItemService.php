<?php
namespace WarehouseCore\Service\Inventory;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Catalog\VehicleRepository;

use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\DTO\ItemEntity;
use WarehouseCore\Payload\DTO\PartAliasEntity;
use WarehouseCore\Payload\DTO\PartEntity;
use WarehouseCore\Payload\DTO\VehicleEntity;

use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\PartAliasRepository;
use WarehouseCore\Repository\Processing\ItemProcessingStepRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Security\Authorization;

final class ItemService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ItemRepository $item_repository,
        private ItemPlacementRepository $item_placement_repository,
        private ItemProcessingStepRepository $item_processing_step_repository,
        private PhysicalTagRepository $physical_tag_repository,
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
}