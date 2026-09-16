<?php
namespace WarehouseCore\Repository\Security;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Reference\RoleReference;

final class RoleRepository extends Repository
{
    public function hydrate(
        array $raw
    ): RoleReference {
        return RoleReference::fromRaw($raw);
    }

    public function getByName(
        string $name
    ): ?RoleReference {
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