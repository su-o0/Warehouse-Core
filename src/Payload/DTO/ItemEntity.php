<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Type\ItemCondition;
use WarehouseCore\Type\ItemStatus;

final class ItemEntity {
    public function __construct(
        public readonly int $id,
        public readonly int $physical_tag_id,
        public readonly ?int $container_id,
        public readonly int $part_id,
        public readonly ?int $vehicle_id,
        public readonly ?int $owner_id,
        public readonly ?ItemStatus $status,
        public readonly ?ItemCondition $condition,
        public readonly ?string $condition_note,
        public readonly string $created_at,
    ) { }
}