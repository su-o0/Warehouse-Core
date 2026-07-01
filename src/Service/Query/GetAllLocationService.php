<?php 
namespace WarehouseCore\Service\Query;

use AddressInfo;
use WarehouseCore\Payload\Value\AddressValue;
use WarehouseCore\Repository\Topology\LocationRepository;

class GetAllLocationService {
    public function __construct(
        public LocationRepository $location_repository
    ){ }

    public function execute(): array {
        return array_map(
            fn(array $e) => AddressValue::fromRaw($e), $this->location_repository->getAll()
        );
    }
}