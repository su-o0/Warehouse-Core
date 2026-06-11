<?php
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Repository\Identity\PhysicalTagRepository;

class AddPhysicalTagService{
    public function __construct(
        public PhysicalTagRepository $physical_tag
        ) {
    }

    public function execute(int $TagId): void {
        $Tag = $this->physical_tag->findById($TagId);
        if($Tag !== null)
            throw new \RuntimeException("Бирка $TagId уже существует");

        $this->physical_tag->add($TagId, "Free");
    }
}