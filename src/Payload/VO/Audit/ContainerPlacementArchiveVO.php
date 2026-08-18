<?php 
namespace WarehouseCore\Payload\VO\Audit;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ValidationException;

final class ContainerPlacementArchiveVO {
    use ConfigHelper;
    public function __construct(
        public int $container_id,
        public ?int $to_zone_id,
        public ?int $to_shelf_id,
        public int $created_by_user_id,
        public string $created_at,
    ) { }

    public static function fromRaw(array $raw): self {
        $to_zone_id = self::nullableInt($raw, 'to_zone_id');
        $to_shelf_id = self::nullableInt($raw, 'to_shelf_id');

        if (!self::xor($to_zone_id, $to_shelf_id)) {
            throw ValidationException::EXACTLY_ONE_REQUIRED(
                ErrorCode::CONTAINER_PLACEMENT_INVALID_TARGET,
                ['to_zone_id', 'to_shelf_id']
            );
        }

        return new self(
            container_id: self::requiredInt($raw, 'container_id'),
            to_zone_id: $to_zone_id,
            to_shelf_id: $to_shelf_id,
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}