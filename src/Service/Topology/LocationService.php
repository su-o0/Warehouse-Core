<?php 
namespace WarehouseCore\Service\Topology;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Value\AddressValue;
use WarehouseCore\Security\Authorization;

final class LocationService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private LocationRepository $location_repository
    ) { }

    public function create(
        AddressValue $address
    ): ServiceResult {
        if(!$this->authorization->canCreateLocation()) {
            return new ServiceResult( 
                success: false,
                message: ErrorMessage::AUTHENTICATION_FAILED 
            );
        }

        try {   
            $location_id = $this->location_repository->add(
                $this->authorization->user->id,
                $address->getValue()
            );

            return new ServiceResult(
                success: true,
                message: $location_id
            );
        }catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
    }
}