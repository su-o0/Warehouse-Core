<?php 
namespace WarehouseCore\Payload\VO\Relationship;

use WarehouseCore\Config\ConfigHelper;

final readonly class ZonePlacementVO {
    use ConfigHelper;
    public function __construct(
        public int $record_id,
        public int $area_id,
        public int $zone_id,
        public string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {        
        return new self(
            record_id: self::requiredInt($raw, 'record_id'),
            area_id: self::requiredInt($raw, 'area_id'),
            zone_id: self::requiredInt($raw, 'zone_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}