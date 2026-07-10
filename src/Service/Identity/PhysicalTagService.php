<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\PhysicalTagRepository;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\Result\SetupResult;

final class PhysicalTagService {
    public function __construct(
        private PhysicalTagRepository $physical_tag_repository
    ) { }

    public function create(
        int $tag_id
    ): SetupResult {
        $Tag = $this->physical_tag_repository->findById($tag_id);
        if($Tag !== null)   
            return new SetupResult(
                success: false,
                message: DomainException::PHYSICAL_TAG_ALREADY_EXISTS()->getMessage()
            );

        try {
            $this->physical_tag_repository->add($tag_id, "Free");
        }catch(RepositoryException $e) {
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