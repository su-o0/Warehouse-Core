<?php
namespace SuO0\StorageApi\Service\Setup;
use SuO0\StorageApi\Repository\Audit\OwnerRepository;

class AddOwnerService {
    public function __construct(
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
