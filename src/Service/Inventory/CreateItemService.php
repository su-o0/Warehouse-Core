<?php 
namespace WarehouseCore\Service\Inventory;

use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\DTO\ItemEntity;
use WarehouseCore\Payload\DTO\PartEntity;
use WarehouseCore\Payload\DTO\VehicleEntity;
use WarehouseCore\Payload\Result\SetupResult;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Catalog\VehicleRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;

class CreateItemService {

    public function __construct(
        private PartRepository $part_repository,
        private VehicleRepository $vehicle_repository,
        private ItemRepository $item_repository
    ) { }

    public function execute(
        int $owner_id,
        string $article,
        int $vehicle_id,
        string $condition_level,
        string $condition_note,
        string $vehicle
    ): SetupResult {
        try {
            $part_entity = PartEntity::fromRaw(
                $this->part_repository->findOrCreate($article)
            );
            $vehicle_entity = empty($vehicle_id)? null :
                VehicleEntity::fromRaw(
                    $this->vehicle_repository->findById($vehicle_id)
            );
        } catch(RepositoryException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }
        
        try {
            $item_id = $this->item_repository->add(
                $owner_id,
                $part_entity->id,
                'Good',
                ($vehicle_entity === null)?null:$vehicle_entity->id
            );
        }catch(RepositoryException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new SetupResult(
            success: true,
            entity: ItemEntity::fromRaw(
                $this->item_repository->findById($item_id)
            )
        );
    }
}