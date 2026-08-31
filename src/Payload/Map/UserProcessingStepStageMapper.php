<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;

final class UserProcessingStepStageMapper implements Mapper {
    public static function match(
        string $field
    ) : UserProcessingStepStageEnum {
        return match ($field) {
            'Named'      => UserProcessingStepStageEnum::Named,
            'AssignRole'      => UserProcessingStepStageEnum::AssignRole,
            'Identify'      => UserProcessingStepStageEnum::Identify,
            default         => throw DomainException::USER_PROCESSING_STEP_STAGE_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw,
        string $field
    ): UserProcessingStepStageEnum {
       return self::match($raw[$field]);
    }
}
    