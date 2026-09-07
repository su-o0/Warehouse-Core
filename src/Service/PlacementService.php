<?php
namespace WarehouseCore\Service;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Enum\AreaStatusEnum;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Inventory\ContainerRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\RackRepository;
use WarehouseCore\Repository\Topology\ShelfRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\RackPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Topology\ZoneRepository;
use WarehouseCore\Security\Authorization;

final class PlacementService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private AreaRepository $area_repository, 
        private ZoneRepository $zone_repository, 
        private RackRepository $rack_repository, 
        private ShelfRepository $shelf_repository, 
        private ContainerRepository $container_repository,
        private ItemRepository $item_repository,
        private StockRepository $stock_repository,
        private RackPlacementRepository $rack_placement_repository, 
        private ContainerPlacementRepository $container_placement_repository,
        private ItemPlacementRepository $item_placement_repository,
        private StockPlacementRepository $stock_placement_repository
    ) { }

    private function existsArea(
        int $id
    ): ServiceResult {
        try { 
            $result = $this->area_repository->getById($id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    private function existsZone(
        int $id
    ): ServiceResult {
        try { 
            $result = $this->zone_repository->getById($id);
        } catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        if ($result === null) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::ZONE_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

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


    public function placeRackToArea(
        int $rack_id,
        int $area_id,
    ) {
        if (!$this->authorization->canPlaceRackToArea()) {
            throw ServiceException::FORBIDDEN();
        }

        $result = $this->existsRack($rack_id);

        if(!$result->success) {
            return $result;
        }

        $rack = $result->entity;

        $result = $this->existsArea($rack_id);

        if(!$result->success) {
            return $result;
        }

        $area = $result->entity;

        if (!in_array(
            $rack->status,
            [
                RackStatusEnum::Processing,
                RackStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::RACK_INVALID_STATUS_TRANSITION
            );
        }

        if (!in_array(
            $area->status,
            [
                AreaStatusEnum::Active
            ],
            true
        )) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AREA_INVALID_STATUS_TRANSITION
            );
        }


        




    }


    public function placeRackToZone() {
        if (!$this->authorization->canPlaceRackToZone()) {
            throw ServiceException::FORBIDDEN();
        }
    }


}
