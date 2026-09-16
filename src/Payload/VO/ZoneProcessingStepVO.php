<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ZoneProcessingStepStageMapper;
use WarehouseCore\Payload\Enum\ZoneProcessingStepStageEnum;

final readonly class ZoneProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $record_id,
        public int $zone_id,
        public ZoneProcessingStepStageEnum $stage,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            record_id: self::requiredInt($raw, 'record_id'),
            zone_id: self::requiredInt($raw, 'zone_id'),
            stage: ZoneProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}