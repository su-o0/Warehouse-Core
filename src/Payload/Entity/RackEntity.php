<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\RackStatusMapper;
use WarehouseCore\Payload\Enum\RackStatusEnum;

final readonly class RackEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public RackStatusEnum $status,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::required($raw, 'id'),
            status: RackStatusMapper::match(
                self::requiredString($raw, 'status')
            ),
            created_by_user_id: self::requiredString($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}