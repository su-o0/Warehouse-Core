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
        public readonly int $created_by_user_id,
        public readonly string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            physical_tag_id: self::requiredInt($raw, 'physical_tag_id'),
            part_id: self::requiredInt($raw, 'part_id'),
            vehicle_id: self::nullableInt($raw, 'vehicle_id'),
            owner_id: self::nullableInt($raw, 'owner_id'),
            status: ItemStatusValue::fromRaw($raw, 'status'),
            condition: ItemConditionValue::fromRaw($raw, 'condition'),
            condition_note: $raw['condition_note'] ?? null,
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }
}