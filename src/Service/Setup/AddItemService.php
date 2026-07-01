<?php 
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\DTO\ItemEntity;
use WarehouseCore\Payload\DTO\PartEntity;
use WarehouseCore\Payload\DTO\PhysicalTagEntity;
use WarehouseCore\Payload\DTO\VehicleEntity;
use WarehouseCore\Payload\Result\SetupResult;
use WarehouseCore\Repository\Identity\PhysicalTagRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Catalog\VehicleRepository;
use WarehouseCore\Payload\Type\PhysicalTagStatus;

class AddItemService {
    public function __construct(
        private PhysicalTagRepository $physical_tag_repository,
        private ItemRepository $item_repository,
        private PartRepository $part_repository,
        private VehicleRepository $vehicle_repository
    ) { }

    public function execute(
        int $tag_id, 
        string $article, 
        ?int $vehicle_id = null
    ): SetupResult {
        $physical_tag_entity = $this->physical_tag_repository->findById($tag_id);
        if($physical_tag_entity === null) 
            return new SetupResult(
                success: false,
                message: DomainException::PHYSICAL_TAG_NOT_FOUND()->getMessage()
            );

        try{
            $physical_tag_entity = PhysicalTagEntity::fromRaw(
                $physical_tag_entity
            );  
        }catch(DomainException $e){
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if($physical_tag_entity->status != PhysicalTagStatus::Free)
            return new SetupResult(
                success: false,
                message: DomainException::PHYSICAL_TAG_NOT_AVAILABLE()->getMessage()
            );

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
                $physical_tag_entity->id,
                $part_entity->id,
                ($vehicle_entity === null)?null:$vehicle_entity->id
            );
            $this->physical_tag_repository->updateStatus(
                $physical_tag_entity->id, 
                'Assigned'
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