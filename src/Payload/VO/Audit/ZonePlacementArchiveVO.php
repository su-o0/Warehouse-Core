<?php 
namespace WarehouseCore\Payload\VO\Audit;

use WarehouseCore\Config\ConfigHelper;

final class ZonePlacementArchiveVO {
    use ConfigHelper;
    public function __construct(
        public int $zone_id,
        public int $to_area_id,
        public int $created_by_user_id,
        public string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            zone_id: self::requiredInt($raw, 'zone_id'),
            to_area_id: self::requiredInt($raw, 'to_area_id'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}