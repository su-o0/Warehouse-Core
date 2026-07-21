<?php

namespace WarehouseCore\Service\Catalog;

use WarehouseCore\Repository\Catalog\PartRepository;

use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\DTO\PartEntity;

use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\PartAliasRepository;
use WarehouseCore\Security\Authorization;

final class PartService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private PartRepository $part_repository,
        private PartAliasRepository $part_alias_repository
    ) {}

    public function normalizeArticle(
        string $article
    ): string {
        return strtoupper(preg_replace('/[\s\-]+/', '', $article));
    }

    public function create(
        string $article,
        ?string $name = null
    ): ServiceResult {
        try {
            $part_id = $this->part_repository->add(
                $article, 
                $name
            );
        } catch (RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true,
            entity: $part_id
        );
    }
}
