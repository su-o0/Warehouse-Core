<?php 
namespace WarehouseCore\Payload\VO\Relationship;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ValidationException;

final readonly class ItemPlacementVO {
    use ConfigHelper;
    public function __construct(
        public ?int $zone_id,
        public ?int $shelf_id,
        public ?int $container_id,
        public int $item_id,
        public string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        $zone_id = self::nullableInt($raw, 'zone_id');
        $shelf_id = self::nullableInt($raw, 'shelf_id');
        $container_id = self::nullableInt($raw, 'container_id');

        if (!self::xor3($zone_id, $shelf_id, $container_id)) {
            throw ValidationException::EXACTLY_ONE_REQUIRED(
                ErrorCode::ITEM_PLACEMENT_INVALID_TARGET,
                ['zone_id', 'shelf_id', 'container_id']
            );
        }
        
        return new self(
            zone_id: $zone_id,
            shelf_id: $shelf_id,
            container_id: $container_id,
            item_id: self::requiredInt($raw, 'item_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}