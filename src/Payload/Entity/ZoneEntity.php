<?php 
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ZoneStatusMapper;
use WarehouseCore\Payload\Enum\ZoneStatusEnum;

final readonly class ZoneEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public int $area_id,
        public ZoneStatusEnum $status,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            area_id: self::requiredInt($raw, 'area_id'),
            status: ZoneStatusMapper::match(
               self::requiredString($raw, 'status')
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}