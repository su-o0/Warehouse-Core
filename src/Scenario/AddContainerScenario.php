<?php
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\LocationRepository;
use SuO0\StorageApi\Repository\ContainerRepository;

class AddContainerScenario {
    public function __construct(
        private LocationRepository $Location,
        private ContainerRepository $Container
        ) {
    }

    public function execute(string $Address, string $ContainerId, string $Type): void {
        $Location = $this->Location->findByAddress($Address);
        if($Location === null)
            throw new \RuntimeException("Адресс $Address не существует");

        $this->Container->add($ContainerId, $Location['IdA'], $Type);
    }
}