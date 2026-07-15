<?php
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Type\ItemProcessingStage;
use WarehouseCore\Payload\Map\ItemProcessingStageMapper;

final class ItemProcessingStageValue {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly int $item_id,
        public readonly ItemProcessingStage $stage,
        public readonly string $meta_data,
        public readonly int $created_by_user_id,
        public readonly string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            item_id: self::requiredInt($raw, 'item_id'),
            stage: ItemProcessingStageMapper::fromRaw($raw, 'stage'),
            meta_data: self::requiredString($raw, 'meta_data'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}