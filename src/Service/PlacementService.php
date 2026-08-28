<?php
namespace WarehouseCore\Service;

use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\PlacementTarget;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Security\Authorization;

final class PlacementService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private ContainerPlacementRepository $container_placement_repository,
        private ItemPlacementRepository $item_placement_repository,
        private StockPlacementRepository $stock_placement_repository
    ) { }

    public function placeContainer(
        int $location_id,
        int $container_id
    ): ServiceResult {
        try{
            $result = $this->container_placement_repository->add(
                $location_id,
                $container_id
            );
            return new ServiceResult(success: true, entity: $result);
        } catch (RepositoryException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        }
    }

    public function placeItemToContainer(
        int $container_id,
        int $item_id
    ): ServiceResult {
        try{
            $result = $this->item_placement_repository->addByContainerId(
                $container_id,
                $item_id
            );
            return new ServiceResult(success: true, entity: $result);
        } catch (RepositoryException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        }
    }

    public function placeItemToLocation(
        int $location_id,
        int $item_id
    ): ServiceResult {
        try{
            $result = $this->item_placement_repository->addByLocationId(
                $location_id,
                $item_id
            );
            return new ServiceResult(success: true, entity: $result);
        } catch (RepositoryException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        }
    }

    public function placeStock(
        int $stock_id,
        int $location_id
    ) {

    }

    public function removeContainer(
        int $container_id
    )  {

    }

    public function removeItem(
        int $item_id
    )  {

    }

    public function removeStock(
        int $stock_id
    )  {

    }
}
