<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\PartProcessingStepStageEnum;
use WarehouseCore\Payload\Map\PartProcessingStepStageMapper;

final class PartProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $part_id,
        public PartProcessingStepStageEnum $stage,
        public string $metadata,
        public int $created_by_user_id,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            part_id: self::requiredInt($raw, 'part_id'),
            stage: PartProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            metadata: self::requiredString($raw, 'metadata'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}