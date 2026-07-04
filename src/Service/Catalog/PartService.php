<?php 
namespace WarehouseCore\Service\Catalog;

use WarehouseCore\Repository\Catalog\PartRepository;

use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\DTO\PartEntity;

use WarehouseCore\Payload\Result\SetupResult;

final class PartService {
    public function __construct(
        private PartRepository $part_repository
    ) { }

    public function create(
        string $article,
        ?string $name
    ): SetupResult {
        try {
            $part_entity = $this->part_repository->findOrCreate($article, $name);
            if ($part_entity !== null) {
                $part_entity = PartEntity::fromRaw(
                    $part_entity
                );
                $this->part_repository->updateName(
                    $part_entity->id,
                    $name
                );
            }
        } catch (RepositoryException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new SetupResult(
            success: true
        );
    }
}