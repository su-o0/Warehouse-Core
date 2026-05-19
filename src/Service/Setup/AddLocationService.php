<?php
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Repository\Topology\LocationRepository;
        
class AddLocationService {
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