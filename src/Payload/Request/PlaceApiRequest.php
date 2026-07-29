<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\PlacementEntityMapper;
use WarehouseCore\Payload\Map\PlacementTargetMapper;
use WarehouseCore\Payload\Type\PlacementEntity;
use WarehouseCore\Payload\Type\PlacementTarget;

final readonly class PlaceApiRequest {
    use ConfigHelper;
    public function __construct(
        public PlacementEntity $entity,
        public PlacementTarget $target,
        public int $entity_id,
        public int $target_id
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            entity: PlacementEntityMapper::fromString(
                self::requiredString($raw, 'entity')
            ),
            target: PlacementTargetMapper::fromString(
                self::requiredString($raw, 'target')
            ),
            entity_id: self::requiredInt($raw, 'entity_id'),
            target_id: self::requiredInt($raw, 'target_id'),
        );
    }
}