<?php
namespace WarehouseCore\Service\Inventory;

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
        private PartRepository $part_repository,
        private PartAliasRepository $part_alias_repository,
        private VehicleRepository $vehicle_repository
    ) { }

    public function create(
        int $part_id, 
        ?int $vehicle_id = null
    ): ServiceResult {

        try {
            $part_entity = PartEntity::fromRaw(
                $this->part_repository->findOrCreate($article)
            );
            $vehicle_entity = empty($vehicle_id)? null :
                VehicleEntity::fromRaw(
                    $this->vehicle_repository->findById($vehicle_id)
            );
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
        
        try {
            $item_id = $this->item_repository->add(
                $physical_tag_entity->id,
                $part_entity->id,
                ($vehicle_entity === null)?null:$vehicle_entity->id
            );
            $this->physical_tag_repository->updateStatus(
                $physical_tag_entity->id, 
                'Assigned'
            );
        }catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true,
            entity: ItemEntity::fromRaw(
                $this->item_repository->findById($item_id)
            )
        );
    }
}