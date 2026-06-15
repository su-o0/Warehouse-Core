<?php 
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Repository\Inventory\StockRepository;
use WarehouseCore\Repository\Catalog\PartRepository;

use WarehouseCore\Payload\Result\SetupResult;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\DTO\PartEntity;
use WarehouseCore\Payload\DTO\StockEntity;

final class AddStockService {
    function __construct(
        private StockRepository $stock_repository,
        private PartRepository $part_repository    
    ) { }

    public function execute(
        string $article,
        int $qcy,
    ): SetupResult {
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