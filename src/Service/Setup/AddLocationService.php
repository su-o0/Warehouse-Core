<?php
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Repository\Topology\LocationRepository;

use WarehouseCore\Payload\Value\AddressValue;
use WarehouseCore\Payload\Result\SetupResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;

class AddLocationService {
    public function __construct(
        public LocationRepository $location_repository
    ) {  }

    public function execute(
        AddressValue $address_value
    ): SetupResult {
        $location = $this->location_repository->findByAddress($address_value->getValue());
        if($location !== null)
            return new SetupResult(
                success: false,
                message: DomainException::LOCATION_ALREADY_EXISTS()->getMessage()
            );

        try {   
            $this->location_repository->add(
                $address_value->getValue()
            );
        }catch(RepositoryException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new SetupResult(
            success: true
        );
    }
}