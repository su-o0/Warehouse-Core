<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ContainerProcessingStepStageMapper;
use WarehouseCore\Payload\Enum\ContainerProcessingStepStageEnum;

final readonly class ContainerProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $record_id,
        public int $container_id,
        public ContainerProcessingStepStageEnum $stage,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            record_id: self::requiredInt($raw, 'record_id'),
            container_id: self::requiredInt($raw, 'container_id'),
            stage: ContainerProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}