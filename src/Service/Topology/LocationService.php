<?php 
namespace WarehouseCore\Service\Topology;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\LocationStatus;
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

        private function changeStatus(
        int $physical_tag_id,
        LocationStatus $status
    ): ServiceResult {
        try {
            $result = $this->location_repository->updateStatus(
                $physical_tag_id,
                $status->value
            );
        }catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: $result
        );
    }

    public function setActive(
        int $physical_tag_id
    ): ServiceResult {
        return $this->changeStatus(
            $physical_tag_id,
            LocationStatus::Active
        );
    }

    public function setArchived(
        int $physical_tag_id
    ): ServiceResult {
        return $this->changeStatus(
            $physical_tag_id,
            LocationStatus::Archived
        );
    }
}