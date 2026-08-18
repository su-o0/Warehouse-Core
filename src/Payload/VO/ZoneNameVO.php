<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;

final class ZoneNameVO {
    use ConfigHelper;
    public function __construct(
        public int $zone_id,
        public string $value,
        public bool $is_primary,
        public int $created_by_user_id,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            zone_id: self::requiredInt($raw, 'zone_id'),
            value: self::requiredString($raw, 'value'),
            is_primary: self::required($raw, 'is_primary'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}