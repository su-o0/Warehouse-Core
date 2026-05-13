<?php
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\PhysicalTagRepository;

class AddPhysicalTagScenario {
    public function __construct(
        public PhysicalTagRepository $PhysicalTag
        ) {
    }

    public function execute(int $TagId): void {
        $Tag = $this->PhysicalTag->findByIdPhysicalTag($TagId);
        if($Tag !== null)
            throw new \RuntimeException("Бирка $TagId уже существует");

        $this->PhysicalTag->add($TagId, "Free");
    }
}