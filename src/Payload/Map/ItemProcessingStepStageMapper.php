<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ItemProcessingStepStageEnum;

final class ItemProcessingStepStageMapper implements Mapper {
    public static function match(
        string $field
    ) : ItemProcessingStepStageEnum {
        return match ($field) {
            'Identified'      => ItemProcessingStepStageEnum::Identified,
            'Photo'         => ItemProcessingStepStageEnum::Photo,
            'Inspection'    => ItemProcessingStepStageEnum::Inspection,
            'Placement'     => ItemProcessingStepStageEnum::Placement,
            default         => throw DomainException::ITEM_PROCESSING_STEP_STAGE_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw,
        string $field
    ): ItemProcessingStepStageEnum {
       return self::match($raw[$field]);
    }
}
    