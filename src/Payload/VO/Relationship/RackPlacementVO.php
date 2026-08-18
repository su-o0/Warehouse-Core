<?php 
namespace WarehouseCore\Payload\VO\Relationship;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ValidationException;

final readonly class RackPlacementVO {
    use ConfigHelper;
    public function __construct(
        public ?int $area_id,
        public ?int $zone_id,
        public int $rack_id,
        public string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        $area_id = self::nullableInt($raw, 'area_id');
        $zone_id = self::nullableInt($raw, 'zone_id');

        if (!self::xor($area_id, $zone_id)) {
            throw ValidationException::EXACTLY_ONE_REQUIRED(
                ErrorCode::RACK_PLACEMENT_INVALID_TARGET,
                ['area_id', 'zone_id']
            );
        }

        return new self(
            area_id: $area_id,
            zone_id: $zone_id,
            rack_id: self::requiredInt($raw, 'rack_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}