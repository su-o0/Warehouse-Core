<?php 
namespace SuO0\StorageApi\Scenario;

use SuO0\StorageApi\Repository\LocationRepository;
use SuO0\StorageApi\Repository\ContainerRepository;
use SuO0\StorageApi\Repository\PhysicalTagRepository;
use SuO0\StorageApi\Repository\ItemRepository;
use SuO0\StorageApi\Repository\ItemPhotoRepository;
use SuO0\StorageApi\Repository\OwnerRepository;

class AddItemScenario {
    public function __Construct(
        private LocationRepository $Location,
        private ContainerRepository $Container,
        private PhysicalTagRepository $PhysicalTag,
        private ItemRepository $Item,
        private ItemPhotoRepository $ItemPhoto,
        private OwnerRepository $Owner
    ) {

    }

    public function execute():void {

    }
}