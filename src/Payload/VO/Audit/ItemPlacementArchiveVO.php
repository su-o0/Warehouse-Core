<?php 
namespace WarehouseCore\Payload\VO\Audit;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ValidationException;

final readonly class ItemPlacementArchiveVO {
    use ConfigHelper;
    public function __construct(
        public int $item_id,
        public ?int $to_zone_id,
        public ?int $to_shelf_id,
        public ?int $to_container_id,
        public int $created_by_user_id,
        public string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        $to_zone_id = self::nullableInt($raw, 'to_zone_id');
        $to_shelf_id = self::nullableInt($raw, 'to_shelf_id');
        $to_container_id = self::nullableInt($raw, 'to_container_id');

        if (!self::xor3($to_zone_id, $to_shelf_id, $to_container_id)) {
            throw ValidationException::EXACTLY_ONE_REQUIRED(
                ErrorCode::ITEM_PLACEMENT_INVALID_TARGET,
                ['to_zone_id', 'to_shelf_id', 'to_container_id']
            );
        }

        return new self(
            item_id: self::requiredInt($raw, 'item_id'),
            to_zone_id: $to_zone_id,
            to_shelf_id: $to_shelf_id,
            to_container_id: $to_container_id,
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}