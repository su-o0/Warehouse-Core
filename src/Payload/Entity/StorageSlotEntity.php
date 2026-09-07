<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\StorageSlotStatusEnum;
use WarehouseCore\Payload\Map\StorageSlotStatusMapper;

final readonly class StorageSlotEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public int $rack_id,
        public int $slot_position,
        public StorageSlotStatusEnum $status,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::required($raw, 'id'),
            rack_id: self::requiredInt($raw, 'rack_id'),
            slot_position: self::requiredInt($raw, 'slot_position'),
            status: StorageSlotStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}