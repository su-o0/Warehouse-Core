<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ZoneProcessingStepStageEnum;

final class ZoneProcessingStepStageMapper implements Mapper {
    public static function match(
        string $field
    ) : ZoneProcessingStepStageEnum {
        return match ($field) {
            'Placed'    => ZoneProcessingStepStageEnum::Placed,
            default         => throw DomainException::ZONE_PROCESSING_STEP_STAGE_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw,
        string $field
    ): ZoneProcessingStepStageEnum {
       return self::match($raw[$field]);
    }
}