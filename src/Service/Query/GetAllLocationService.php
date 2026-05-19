<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Repository\Topology\LocationRepository;

class GetAllLocationService {
    public function __construct(
        public LocationRepository $LocationRepository
    ){ }

    public function execute(): void {
        echo "Locations:\n";
        $locations = $this->LocationRepository->getAll();
        foreach ($locations as $location) {
            echo "- {$location['Address']}\n";
        }
    }
}