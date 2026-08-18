<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\ItemConditionEnum;
use WarehouseCore\Payload\Enum\ItemStatusEnum;
use WarehouseCore\Payload\Map\ItemStatusMapper;
use WarehouseCore\Payload\Map\ItemConditionMapper;

final readonly class ItemEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public ?int $physical_tag_id,
        public ?int $vehicle_id,
        public ?int $owner_id,
        public ItemStatusEnum $status,
        public ?ItemConditionEnum $condition,
        public ?string $condition_note,
        public int $created_by_user_id,
        public string $created_at,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        $condition = self::nullableString(
            $raw,
            'condition_level'
        );
        
        return new self(
            id: self::requiredInt($raw, 'id'),
            physical_tag_id: self::nullableInt($raw, 'physical_tag_id'),
            vehicle_id: self::nullableInt($raw, 'vehicle_id'),
            owner_id: self::nullableInt($raw, 'owner_id'),
            status: ItemStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            condition: $condition !== null ? ItemConditionMapper::match($condition) : null,
            condition_note: self::nullableString($raw, 'condition_note'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }
}