<?php
namespace WarehouseCore\Service\Catalog;

use WarehouseCore\Repository\Catalog\VehicleRepository;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Security\Authorization;

final class VehicleService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private VehicleRepository $vehicle_repository
    ) { }

    public function create(
        string $vin
    ): ServiceResult {

        $vehicle_entity = $this->vehicle_repository->findByVin($vin);
        if($vehicle_entity !== null)
            return new ServiceResult(
                success: false,
                message: DomainException::VEHICLE_ALREADY_EXISTS()->getMessage()
            );

        try {
            $this->vehicle_repository->add($vin);
        }catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: true
        );
    }
}