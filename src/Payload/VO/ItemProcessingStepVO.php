<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ItemProcessingStepStageMapper;
use WarehouseCore\Payload\Enum\ItemProcessingStepStageEnum;

final readonly class ItemProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $record_id,
        public int $item_id,
        public ItemProcessingStepStageEnum $stage,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            record_id: self::requiredInt($raw, 'record_id'),
            item_id: self::requiredInt($raw, 'item_id'),
            stage: ItemProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}