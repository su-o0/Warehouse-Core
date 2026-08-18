<?php 
namespace WarehouseCore\Payload\VO\Audit;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ValidationException;

final class ItemMovementArchiveValue {
    use ConfigHelper;
    public function __construct(
        public readonly int $item_id,
        public readonly ?int $from_zone_id,
        public readonly ?int $from_shelf_id,
        public readonly ?int $from_container_id,
        public readonly ?int $to_zone_id,
        public readonly ?int $to_shelf_id,
        public readonly ?int $to_container_id,
        public readonly int $created_by_user_id,
        public readonly int $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        $from_zone_id = self::nullableInt($raw, 'from_zone_id');
        $from_shelf_id = self::nullableInt($raw, 'from_shelf_id');
        $from_container_id = self::nullableInt($raw, 'from_container_id');
        $to_zone_id = self::nullableInt($raw, 'to_zone_id');
        $to_shelf_id = self::nullableInt($raw, 'to_shelf_id');
        $to_container_id = self::nullableInt($raw, 'to_container_id');

        if(!self::xor3($from_zone_id, $from_shelf_id, $from_container_id)){
            throw ValidationException::EXACTLY_ONE_REQUIRED(
                ErrorCode::ITEM_MOVEMENT_FROM_INVALID_TARGET,
                ['from_zone_id', 'from_shelf_id', 'from_container_id']
            );
        }

        if(!self::xor3($to_zone_id, $to_shelf_id, $to_container_id)){
            throw ValidationException::EXACTLY_ONE_REQUIRED(
                ErrorCode::ITEM_MOVEMENT_TO_INVALID_TARGET,
                ['to_zone_id', 'to_shelf_id', 'to_container_id']
            );
        }

        return new self(
            item_id: self::requiredInt($raw, 'item_id'),
            from_zone_id: $from_zone_id,
            from_shelf_id: $from_shelf_id,
            from_container_id: $from_container_id,
            to_zone_id: $to_zone_id,
            to_shelf_id: $to_shelf_id,
            to_container_id: $to_container_id,
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredInt($raw, 'created_at')
        );
    }
}