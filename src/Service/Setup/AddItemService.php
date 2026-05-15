<?php 
namespace SuO0\StorageApi\Service\Setup;

use SuO0\StorageApi\Repository\Topology\LocationRepository;
use SuO0\StorageApi\Repository\Topology\ItemPlacementRepository;
use SuO0\StorageApi\Repository\Topology\PhysicalTagRepository;
use SuO0\StorageApi\Repository\Inventory\ItemRepository;
use SuO0\StorageApi\Repository\Catalog\PartRepository;
use SuO0\StorageApi\Repository\Catalog\CarRepository;

class AddItemService {
    public function __Construct(
        private LocationRepository $Location,
        private ItemPlacementRepository $ItemPlacement,
        private PhysicalTagRepository $PhysicalTag,
        private ItemRepository $Item,
        private PartRepository $Part,
        private CarRepository $Car,
    ) {

    }

    public function execute(string $Address, int $IdPhysicalTag, string $Article, ?int $Car = null):void {
        $Location = $this->Location->findByAddress($Address);
        if(!$Location)
            throw new \RuntimeException("Адрес не найден");

        $PhysicalTag = $this->PhysicalTag->findById($IdPhysicalTag);
        if(!$PhysicalTag) 
            throw new \RuntimeException("Физический идентификатор не найден");

        if($PhysicalTag['Status'] != "Free")
            throw new \RuntimeException("Виберете другой физический идентификатор");

        $Part = $this->Part->findOrCreate($Article);
        // $Car = $this->Car->findOrCreate($Article);
        
        if($this->Item->findByPhysicalTagIdStatus($IdPhysicalTag, "Active") !== null)
            throw new \RuntimeException("Физический идентификатор уже занят");

        $ItemId = $this->Item->add($IdPhysicalTag, $Part['Id'], $Car);
        $this->ItemPlacement->add($Location['Id'], $ItemId);
        $this->PhysicalTag->updateStatus($IdPhysicalTag, 'Assigned');
        echo "Предмет с физической меткой $IdPhysicalTag и артикулом $Article добавлен по адресу $Address\n";
    }
}