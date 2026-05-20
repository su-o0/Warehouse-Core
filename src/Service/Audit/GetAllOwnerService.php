<?php
namespace WarehouseCore\Service\Audit;
use WarehouseCore\Repository\Audit\OwnerRepository;

class GetAllOwnerService {
    public function __construct(
        private OwnerRepository $Owner
    ) {}

    public function execute(): void {
        echo "Owners:\n";
        $owners = $this->Owner->getAll();
        foreach ($owners as $owner) {
            echo "- {$owner['Name']}\n";
        }
    }
}