<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ItemProcessingStepStageMapper;
use WarehouseCore\Payload\Enum\ItemProcessingStepStageEnum;

final readonly class ItemProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $item_id,
        public ItemProcessingStepStageEnum $stage,
        public string $metadata,
        public int $created_by_user_id,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            item_id: self::requiredInt($raw, 'item_id'),
            stage: ItemProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            metadata: self::requiredString($raw, 'metadata'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}