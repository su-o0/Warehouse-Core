<?php

namespace WarehouseCore\Service;

use WarehouseCore\Repository\Catalog\PartRepository;

use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Catalog\PartNameRepository;
use WarehouseCore\Repository\Catalog\PartNumberRepository;
use WarehouseCore\Security\Authorization;

final class PartService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private PartRepository $part_repository,
        private PartNumberRepository $part_number_repository,
        private PartNameRepository $part_name_repository
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
