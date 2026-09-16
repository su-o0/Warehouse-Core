<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ContainerProcessingStepStageEnum;

final class ContainerProcessingStepStageMapper implements Mapper {
    public static function match(
        string $field
    ) : ContainerProcessingStepStageEnum {
        return match ($field) {
            'Placed'    => ContainerProcessingStepStageEnum::Placed,
            default         => throw DomainException::CONTAINER_PROCESSING_STEP_STAGE_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw,
        string $field
    ): ContainerProcessingStepStageEnum {
       return self::match($raw[$field]);
    }
}