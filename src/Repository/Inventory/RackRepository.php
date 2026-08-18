<?php
namespace WarehouseCore\Repository\Inventory;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Entity\RackEntity;

final class RackRepository extends Repository {
    public function hydrate(
        array $raw
    ): RackEntity {
        return RackEntity::fromRaw($raw);
    }


}