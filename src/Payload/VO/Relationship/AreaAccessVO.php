<?php 
namespace WarehouseCore\Payload\VO\Relationship;

use WarehouseCore\Config\ConfigHelper;

final readonly class AreaAccessVO {
    use ConfigHelper;
    public function __construct(
        public int $area_id,
        public int $user_id,
        public int $created_by_user_id,
        public string $created_at
    ) {}

    public static function fromRaw(array $raw): self {
        return new self(
            area_id: self::requiredInt($raw, 'area_id'),
            user_id: self::requiredInt($raw, 'user_id'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}