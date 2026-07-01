<?php
namespace WarehouseCore\Service\Query;
use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Repository\Topology\ContainerPlacementRepository;
use WarehouseCore\Repository\Topology\ItemPlacementRepository;
use WarehouseCore\Repository\Topology\StockPlacementRepository;
use WarehouseCore\Repository\Inventory\ItemRepository;
use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Payload\Result\ServiceResult;


class GetLocationContentService {
    public function __construct(
        public LocationRepository $Location,
        public ContainerPlacementRepository $ContainerPlacement,
        public ItemPlacementRepository $ItemPlacement,
        public StockPlacementRepository $StockPlacement,
        public ItemRepository $Item,
        public StockRepository $Stock,
        public PartRepository $Part
        ) {
    }

    public function execute(string $Address): ServiceResult {
        try {
            $Location = $this->Location->findByAddress($Address);
            if($Location === null)
                return new ServiceResult(false, null, "Адрес $Address не найден");

            $result = [
                'address' => $Address,
                'containers' => [],
                'items' => [],
                'stocks' => []
            ];

            $ContainerPlacements = $this->ContainerPlacement->findByLocationId($Location['Id']);
            $ItemPlacements = $this->ItemPlacement->findByLocationId($Location['Id']);
            $StockPlacements = $this->StockPlacement->findByLocationId($Location['Id']);

            if($ContainerPlacements !== null) {
                foreach($ContainerPlacements as $ContainerPlacement) {
                    $container = ['containerId' => $ContainerPlacement['ContainerId'], 'items' => [], 'stocks' => []];
                    $StocksInContainer = $this->Stock->findByContainerId($ContainerPlacement['ContainerId']);
                    if($StocksInContainer !== null) {
                        foreach($StocksInContainer as $Stock) {
                            $Stock = $this->Stock->findById($Stock['Id']);
                            $container['stocks'][] = [
                                'id' => $Stock['Id'],
                                'article' => ($Stock['PartId'] == null)? null : $this->Part->findById($Stock['PartId'])['Article'],
                                'qty' => $Stock['Qty']
                            ];
                        }
                    }

                    $ItemPlacementsInContainer = $this->Item->findByContainerId($ContainerPlacement['ContainerId']);
                    if($ItemPlacementsInContainer !== null) {
                        foreach($ItemPlacementsInContainer as $ItemPlacement) {
                            $container['items'][] = [
                                'physical_tag_id' => $ItemPlacement['PhysicalTagId'],
                                'article' => ($ItemPlacement['PartId'] ? $this->Part->findById($ItemPlacement['PartId'])['Article'] : null)
                            ];
                        }
                    }
                    $result['containers'][] = $container;
                }
            }

            if($ItemPlacements !== null) {
                foreach($ItemPlacements as $ItemPlacement) {
                    $Item = $this->Item->findById($ItemPlacement['ItemId']);
                    $result['items'][] = [
                        'physical_tag_id' => $Item['PhysicalTagId'],
                        'article' => ($Item['PartId'] ? $this->Part->findById($Item['PartId'])['Article'] : null)
                    ];
                }
            }

            if($StockPlacements !== null) {
                foreach($StockPlacements as $StockPlacement) {
                    $Stock = $this->Stock->findById($StockPlacement['StockId']);
                    $result['stocks'][] = [
                        'id' => $Stock['Id'],
                        'article' => ($Stock['PartId'] == null)? null : $this->Part->findById($Stock['PartId'])['Article'],
                        'qty' => $Stock['Qty']
                    ];
                }
            }

            return new ServiceResult(true, $result, null);
        } catch(\RuntimeException $e) {
            return new ServiceResult(false, null, $e->getMessage());
        }
    }

}