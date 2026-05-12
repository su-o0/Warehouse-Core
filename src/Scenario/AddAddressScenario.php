<?php
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\LocationRepository;

class AddAddressScenario {
    public function __construct(
        public LocationRepository $Location
        ) {
    }

    public function execute(string $Address): void {
        $Location = $this->Location->findByAddress($Address);
        if($Location !== null)
            throw new \RuntimeException("Адресс $Address уже существует");

        $this->Location->add($Address);
    }
}