<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Payload\DTO\VehicleEntity;
use WarehouseCore\Repository\Catalog\VehicleRepository;

class GetAllVehicleService {

    public function __construct(
        private VehicleRepository $vehicle_repository
        ) {
    }

    public function execute(): array {
        return array_map(
            fn(array $e) => VehicleEntity::fromRaw($e), $this->vehicle_repository->getAll()
        );
    }
}