<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\PartProcessingStepStageEnum;

final class PartProcessingStepStageMapper implements Mapper {
    public static function match(
        string $field
    ) : PartProcessingStepStageEnum {
        return match ($field) {
            'Identify'      => PartProcessingStepStageEnum::Identify,
            'Capture'       => PartProcessingStepStageEnum::Capture,
            default         => throw DomainException::ITEM_PROCESSING_STEP_STAGE_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw,
        string $field
    ): PartProcessingStepStageEnum {
       return self::match($raw[$field]);
    }
}
    