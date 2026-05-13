<?php 
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\PhysicalTagRepository;
use SuO0\StorageApi\Repository\ItemRepository;
use SuO0\StorageApi\Repository\PartRepository;
use SuO0\StorageApi\Repository\CarRepository;

class AddItemScenario {
    public function __Construct(
        private PhysicalTagRepository $PhysicalTag,
        private ItemRepository $Item,
        private PartRepository $Part,
        private CarRepository $Car,
    ) {

    }

    public function execute(int $IdPhysicalTag, int $Article, ?int $Car = null):void {
        $PhysicalTag = $this->PhysicalTag->findById($IdPhysicalTag);
        if(!$PhysicalTag) 
            throw new \RuntimeException("Физический идентификатор не найден");

        if($PhysicalTag['Status'] != "Free")
            throw new \RuntimeException("Виберете другой физический идентификатор");

        $Part = $this->Part->findOrCreate($Article);
        // $Car = $this->Car->findOrCreate($Article);

        if(!$this->Item->findActiveByIdTag($IdPhysicalTag))
            throw new \RuntimeException("Физический идентификатор уже занят");

        $this->Item->add($IdPhysicalTag, $Part['Id'], $Car);
    }
}