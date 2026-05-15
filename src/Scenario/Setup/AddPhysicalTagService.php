<?php
namespace SuO0\StorageApi\Service\Setup;

use SuO0\StorageApi\Repository\Topology\PhysicalTagRepository;

class AddPhysicalTagService{
    public function __construct(
        public PhysicalTagRepository $PhysicalTag
        ) {
    }

    public function execute(int $TagId): void {
        $Tag = $this->PhysicalTag->findById($TagId);
        if($Tag !== null)
            throw new \RuntimeException("Бирка $TagId уже существует");

        $this->PhysicalTag->add($TagId, "Free");
    }
}