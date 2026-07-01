<?php
namespace WarehouseCore\Service\Audit;
use WarehouseCore\Repository\Identity\OwnerRepository;
use WarehouseCore\Payload\Result\ServiceResult;

class GetAllOwnerService {
    public function __construct(
        private OwnerRepository $Owner
    ) {}

    public function execute(): ServiceResult {
        try {
            $owners = $this->Owner->getAll();
            return new ServiceResult(true, $owners, null);
        } catch (\RuntimeException $e) {
            return new ServiceResult(false, null, $e->getMessage());
        }
    }
}