<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;
use WarehouseCore\Payload\Map\RackProcessingStepStageMapper;

final class RackProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $record_id,
        public int $rack_id,
        public RackProcessingStepStageEnum $stage,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            record_id: self::requiredInt($raw, 'record_id'),
            rack_id: self::requiredInt($raw, 'rack_id'),
            stage: RackProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}