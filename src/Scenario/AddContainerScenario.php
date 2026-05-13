<?php
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\ContainerRepository;

class AddContainerScenario {
    public function __construct(
        private ContainerRepository $Container
        ) {
    }

    public function execute(string $ContainerId, string $Type): void {
        $this->Container->add($ContainerId, $Type);
    }
}