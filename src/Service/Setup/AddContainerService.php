<?php
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Repository\Inventory\ContainerRepository;

class AddContainerService {
    public function __construct(
        private ContainerRepository $Container
        ) {
    }

    public function execute(string $ContainerId, string $Type): void {
        echo "Добавление контейнера $ContainerId типа $Type\n"; 
        $Container = $this->Container->findById($ContainerId);
        if($Container !== null)
            throw new \RuntimeException("Контейнер $ContainerId уже существует");
        
        if(!$this->Container->isValidType($Type))
            throw new \RuntimeException("Тип $Type не существует");
        
        $this->Container->add($ContainerId, $Type);
}
}