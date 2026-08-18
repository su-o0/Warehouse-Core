<?php
namespace WarehouseCore\Repository\Identity;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Reference\ProviderReference;

final class ProviderRepository extends Repository
{
    public function hydrate(
        array $raw
    ): ProviderReference {
        return ProviderReference::fromRaw($raw);
    }

    public function getByName(
        string $name
    ): ?ProviderReference {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE name = :name",
            [
                ':name' => $name
            ]
        );
    }

    public function getAll(): array
    {
        return $this->entities(
            "SELECT * FROM {$this->table}"
        );
    }
}