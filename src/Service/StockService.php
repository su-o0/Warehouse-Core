<?php
namespace WarehouseCore\Service;

use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Catalog\PartRepository;

use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\Entity\PartEntity;
use WarehouseCore\Payload\Entity\StockEntity;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Security\Authorization;

final class StockService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private StockRepository $stock_repository,
        private PartRepository $part_repository
    ) { }

    public function create(
        string $article,
        int $qcy,
    ): ServiceResult {
        try {
            $part_entity = PartEntity::fromRaw(
                $this->part_repository->findOrCreate($article)
            );
            $stock_id = $this->stock_repository->add($qcy, $part_entity->id);
        } catch(RepositoryException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new SetupResult(
            success: true,
            entity: StockEntity::fromRaw(
                $this->stock_repository->findbyId($stock_id)
            )
        );
    }
}