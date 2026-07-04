<?php 
namespace WarehouseCore\Service\Topology;

use WarehouseCore\Repository\Topology\LocationRepository;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\Value\AddressValue;

use WarehouseCore\Payload\Result\SetupResult;

final class LocationService {
    public function __construct(
        private LocationRepository $location_repository
    ) { }

    public function add(
        string $zone,
        string $rack,
        string $shelf
    ): SetupResult {
        try {
                $address_value = new AddressValue(
                $zone,
                $rack,
                $shelf
            );
        }catch(\Throwable $e) {
            return new SetupResult(
                success: false,
                message: DomainException::LOCATION_ADDRESS_INVALID()->getMessage()
            );
        }

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