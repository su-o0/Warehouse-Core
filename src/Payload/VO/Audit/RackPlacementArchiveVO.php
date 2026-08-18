<?php 
namespace WarehouseCore\Payload\VO\Audit;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ValidationException;

final readonly class RackPlacementArchiveVO {
    use ConfigHelper;
    public function __construct(
        public int $rack_id,
        public ?int $to_area_id,
        public ?int $to_zone_id,
        public int $created_by_user_id,
        public string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        $to_area_id = self::nullableInt($raw, 'to_area_id');
        $to_zone_id = self::nullableInt($raw, 'to_zone_id');

        if (!self::xor($to_area_id, $to_zone_id)) {
            throw ValidationException::EXACTLY_ONE_REQUIRED(
                ErrorCode::RACK_PLACEMENT_INVALID_TARGET,
                ['to_area_id', 'to_zone_id']
            );
        }

        return new self(
            rack_id: self::requiredInt($raw, 'rack_id'),
            to_area_id: $to_area_id,
            to_zone_id: $to_zone_id,
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}