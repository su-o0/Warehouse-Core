<?php
namespace SuO0\StorageApi\Service\Setup;

use SuO0\StorageApi\Repository\Topology\LocationRepository;
        
class AddAddressService {
    public function __construct(
        public LocationRepository $Location
        ) {
    }

    public function execute(string $Address): void {
        echo "Добавление адреса $Address\n";
        $Location = $this->Location->findByAddress($Address);
        if($Location !== null)
            throw new \RuntimeException("Адресс $Address уже существует");

        $this->Location->add($Address);
    }
}