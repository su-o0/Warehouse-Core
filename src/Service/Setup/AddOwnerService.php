<?php
namespace WarehouseCore\Service\Setup;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Identity\OwnerRepository;

class AddOwnerService {
    public function __construct(
        private UserRepository $user,
        private OwnerRepository $Owner
    ) {}

    public function execute(string $UserId, string $Name, string $Permission): void {
        $ExistingOwner = $this->Owner->findByName($Name);
        if($ExistingOwner !== null)
            throw new \RuntimeException("Владелец с именем $Name уже существует");

        $this->Owner->add($Name, $UserId, $Permission);
        echo "Владелец $Name успешно добавлен\n";
    }
}
