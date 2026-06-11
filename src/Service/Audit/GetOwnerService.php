<?php
namespace WarehouseCore\Service\Audit;

use WarehouseCore\Repository\Audit\OwnerRepository;

final class GetOwnerService {
    public function __construct(
        private OwnerRepository $Owner
    ) { }

    public function execute(int $owner_id): void {
        var_export($this->Owner->findByUserId($owner_id));
    }
} 