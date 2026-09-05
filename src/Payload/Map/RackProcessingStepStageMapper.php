<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\RackProcessingStepStageEnum;

final class RackProcessingStepStageMapper implements Mapper {
    public static function match(
        string $field
    ) : RackProcessingStepStageEnum {
        return match ($field) {
            'Populate'      => RackProcessingStepStageEnum::Populate,
            'Placement'     => RackProcessingStepStageEnum::Placement,
            default         => throw DomainException::RACK_PROCESSING_STEP_STAGE_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw,
        string $field
    ): RackProcessingStepStageEnum {
       return self::match($raw[$field]);
    }
}
    