<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\PartProcessingStepStageEnum;
use WarehouseCore\Payload\Map\PartProcessingStepStageMapper;

final class PartProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $record__id,
        public int $part_id,
        public PartProcessingStepStageEnum $stage,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            record__id: self::requiredInt($raw, 'record__id'),
            part_id: self::requiredInt($raw, 'part_id'),
            stage: PartProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}