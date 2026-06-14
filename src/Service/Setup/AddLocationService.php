<?php
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Repository\Topology\LocationRepository;

use WarehouseCore\Payload\DTO\AddressValue;
use WarehouseCore\Payload\Result\SetupResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;

class AddLocationService {
    public function __construct(
        public LocationRepository $location_repository
        ) {
    }

    public function execute(array $address_raw): SetupResult {
        $address_value = AddressValue::fromRaw($address_raw);
        $Location = $this->location_repository->findByAddress($address_value->getValue());
        if($Location !== null)
            return new SetupResult(
                success: false,
                message: DomainException::LOCATION_ALREADY_EXISTS()->getMessage()
            );

        try {
            $this->location_repository->add($address_value->getValue());
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