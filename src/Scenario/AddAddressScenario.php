<?php
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\LocationRepository;

class AddAddressScenario {
    public function __construct(
        public LocationRepository $Location
        ) {
    }

    public function execute(string $Address): void {
        $this->Location->add($Address);
    }
}