<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Type\ItemCondition;
use WarehouseCore\Payload\Type\ItemStatus;
use WarehouseCore\Payload\Value\ItemStatusValue;
use WarehouseCore\Payload\Value\ItemConditionValue;

final class ItemEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly int $physical_tag_id,
        public readonly int $part_id,
        public readonly ?int $vehicle_id,
        public readonly ?int $owner_id,
        public readonly ItemStatus $status,
        public readonly ItemCondition $condition,
        public readonly ?string $condition_note,
        public readonly string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            self::requiredInt($raw, 'id'),
            self::requiredInt($raw, 'physical_tag_id'),
            self::requiredInt($raw, 'part_id'),
            self::nullableInt($raw, 'vehicle_id'),
            self::nullableInt($raw, 'owner_id'),
            ItemStatusValue::fromRaw($raw, 'status'),
            ItemConditionValue::fromRaw($raw, 'condition'),
            self::nullableInt($raw, 'condition_note'),
            self::requiredString($raw, 'created_at'),
        );
    }
}