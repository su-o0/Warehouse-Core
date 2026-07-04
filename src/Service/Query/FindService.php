<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Repository\Topology\LocationRepository;

final class FindService {
    public function __construct(
        private LocationRepository $location_repository
    ) { }

    public function getAllLocations(): array {
        return $this->location_repository->getAll();
    }
}