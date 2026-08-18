<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\ShelfStatusEnum;
use WarehouseCore\Payload\Map\ShelfStatusMapper;

final readonly class ShelfEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public int $rack_id,
        public ShelfStatusEnum $status,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::required($raw, 'id'),
            rack_id: self::requiredString($raw, 'user_id'),
            status: ShelfStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}