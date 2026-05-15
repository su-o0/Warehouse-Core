<?php 
namespace SuO0\StorageApi\Service\Setup;

use SuO0\StorageApi\Repository\Topology\PhysicalTagRepository;
use SuO0\StorageApi\Repository\Inventory\ItemRepository;
use SuO0\StorageApi\Repository\Catalog\PartRepository;
use SuO0\StorageApi\Repository\Catalog\CarRepository;

class AddItemService {
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

        if(!$this->Item->findByPhysicalTagIdStatus($IdPhysicalTag, 'Active'))
            throw new \RuntimeException("Физический идентификатор уже занят");

        $this->Item->add($IdPhysicalTag, $Part['Id'], $Car);
    }
}