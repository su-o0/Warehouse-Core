<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Enum\AreaStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Repository\Audit\ContainerMovementArchiveRepository;
use WarehouseCore\Repository\Audit\ContainerPlacementArchiveRepository;
use WarehouseCore\Repository\Audit\ItemMovementArchiveRepository;
use WarehouseCore\Repository\Audit\ItemPlacementArchiveRepository;
use WarehouseCore\Repository\Audit\ItemSalesArchiveRepository;
use WarehouseCore\Repository\Audit\RackMovementArchiveRepository;
use WarehouseCore\Repository\Audit\RackPlacementArchiveRepository;
use WarehouseCore\Repository\Audit\StockMovementArchiveRepository;
use WarehouseCore\Repository\Audit\StockPlacementArchiveRepository;
use WarehouseCore\Repository\Audit\StockSalesArchiveRepository;
use WarehouseCore\Repository\Catalog\AreaNameRepository;
use WarehouseCore\Repository\Catalog\PartNameRepository;
use WarehouseCore\Repository\Catalog\PartNumberRepository;
use WarehouseCore\Repository\Catalog\RackNameRepository;
use WarehouseCore\Repository\Catalog\ZoneNameRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\PhysicalTagRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Processing\ItemProcessingStepRepository;
use WarehouseCore\Repository\Processing\PartProcessingStepRepository;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\RackPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Topology\ZoneRepository;
use WarehouseCore\Security\Authorization;

final class FindService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ContainerPlacementRepository $container_placement,
        private ItemPlacementRepository $item_placement, 
        private RackPlacementRepository $rack_placement,
        private StockPlacementRepository $stock_placement,
        private AreaRepository $area,
        private ZoneRepository $zone,
        private ItemRepository $item,
        private StockRepository $stock,
        private ContainerRepository $container,
        private ItemProcessingStepRepository $item_processing_step,
        private PartProcessingStepRepository $part_processing_step,
        private UserIdentityRepository $user_identity,
        private UserRepository $user,
        private OwnerRepository $owner,
        private PartNumberRepository $part_number,
        private PartNameRepository $part_name,
        private AreaNameRepository $area_name,
        private RackNameRepository $rack_name,
        private ZoneNameRepository $zone_name,
        private OwnerRepository $owner_repository,
        private PhysicalTagRepository $physical_tag,
        private ItemSalesArchiveRepository $item_sales_archive,
        private StockSalesArchiveRepository $stock_sales_archive,
        private ContainerMovementArchiveRepository $container_movement_archive,
        private ContainerPlacementArchiveRepository $container_placement_archive,
        private ItemMovementArchiveRepository $item_movement_archive,
        private ItemPlacementArchiveRepository $item_placement_archive,
        private RackMovementArchiveRepository $rack_movement_archive,
        private RackPlacementArchiveRepository $rack_placement_archive,
        private StockMovementArchiveRepository $stock_movement_archive,
        private StockPlacementArchiveRepository $stock_placement_archive
    ) { }

    public function findAreaByStatus(
        AreaStatusEnum $status
    ): ServiceResult {
        $result = $this->area->findByStatus(
            $status->value
        );

        if($result === null) {
            return new ServiceResult(
                success: true, 
                entity: null,
                message: ErrorMessage::AREA_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    public function findContainerPlacement(
        int $container_id
    ): ServiceResult {
        $result = $this->container_placement->getByContainerId(
            $container_id
        );

        if($result === null) {
            return new ServiceResult(
                success: true, 
                entity: null,
                message: ErrorMessage::CONTAINER_PLACEMENT_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    public function findItemPlacement(
        int $container_id
    ): ServiceResult {
        $result = $this->container_placement->getByContainerId(
            $container_id
        );

        if($result === null) {
            return new ServiceResult(
                success: true, 
                entity: null,
                message: ErrorMessage::CONTAINER_PLACEMENT_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }


    public function findItemByPhysicalTag(
        int $physical_tag_id
    ): ServiceResult {
        $result = $this->item->findByPhysicalTagId(
            $physical_tag_id
        );

        if($result === null) {
            return new ServiceResult(
                success: true, 
                entity: null,
                message: ErrorMessage::ITEM_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    public function findPartIdByArticle(
        string $article
    ): ServiceResult {
         if (!$this->authorization->canFindArticle()) {
            return new ServiceResult(
                success: false,
                message: ServiceException::FORBIDDEN()->getMessage()
            );
        }

        $part = $this->part_repository->findByArticle($article);

        if ($part !== null) {
            return new ServiceResult(
                success: true,
                entity: $part->id
            );
        }
        
        $alias = $this->part_alias_repository->findByArticle($article);

        if ($alias !== null) {
            return new ServiceResult(
                success: true,
                entity: $alias->part_id
            );
        }

        return new ServiceResult(
            success: true,
            entity: null
        );
    }

    public function findUserIdentity(
        ProviderType $provider,
        string $external_id
    ): ServiceResult {
        if(!$this->authorization->canFindUser()){
            return new ServiceResult(
                success: false,
                message: ServiceException::FORBIDDEN()->getMessage()
            );
        }

        $result = $this->user_identity_repository->findByProviderAndId(
            $provider->value,
            $external_id
        );
        
        if($result === null) {
            return new ServiceResult(
                success: false,
                entity: null
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }


    public function getAllLocations(): array {
        return $this->location_repository->getAll();
    }

    public function findUserByName(
        string $name,
    ): ServiceResult {
        if(!$this->authorization->canFindUser()){
            return new ServiceResult(
                success: false,
                message: ServiceException::FORBIDDEN()->getMessage()
            );
        }

        $result = $this->user_repository->findByName($name);
        
        if($result === null) {
            return new ServiceResult(
                success: false,
                message: DomainException::USER_NOT_FOUND()->getMessage()
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }
    
}