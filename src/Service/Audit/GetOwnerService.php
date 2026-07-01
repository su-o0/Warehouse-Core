<?php
namespace WarehouseCore\Service\Audit;

use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Payload\Result\ServiceResult;

final class GetOwnerService {
    public function __construct(
        private OwnerRepository $owner_repository
    ) { }

    public function execute(int $owner_id): ServiceResult {
        try {
            $owner = $this->owner_repository->findByUserId($owner_id);
            return new ServiceResult(
                true, 
                $owner, 
                null
            );
        } catch (\RuntimeException $e) {
            return new ServiceResult(
                false, 
                null, 
                $e->getMessage()
            );
        }
    }
}