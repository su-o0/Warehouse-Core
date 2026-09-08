<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Result\ServiceResult;
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
use WarehouseCore\Repository\Catalog\UserNameRepository;
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
        private AreaNameRepository $area_name_repository,
        private RackNameRepository $rack_name,
        private ZoneNameRepository $zone_name_repository,
        private UserNameRepository $user_name_repository,
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


    public function findAreaNameByRecordId(
        int $record_id
    ): ServiceResult {
        if (!$this->authorization->canFindAreaName()) {
            throw ServiceException::FORBIDDEN();
        }

        $area_name = $this->area_name_repository->findByRecordId(
            $record_id
        );

        if ($area_name === null) {
            return ServiceResult::failure(
                ErrorMessage::AREA_NAME_NOT_FOUND
            );
        }

        return ServiceResult::entity($area_name);
    }

    public function findZoneNameByRecordId(
        int $record_id
    ): ServiceResult {
        if (!$this->authorization->canFindZoneName()) {
            throw ServiceException::FORBIDDEN();
        }

        $zone_name = $this->zone_name_repository->findByRecordId(
            $record_id
        );

        if ($zone_name === null) {
            return ServiceResult::failure(
                ErrorMessage::ZONE_NAME_NOT_FOUND
            );
        }

        return ServiceResult::entity($zone_name);
    }

    public function findUserNameByRecordId(
        int $record_id
    ): ServiceResult {
        if (!$this->authorization->canFindUserName()) {
            throw ServiceException::FORBIDDEN();
        }

        $user_name = $this->user_name_repository->findByRecordId(
            $record_id
        );

        if ($user_name === null) {
            return ServiceResult::failure(
                ErrorMessage::USER_NAME_NOT_FOUND
            );
        }

        return ServiceResult::entity($user_name);
    }

}