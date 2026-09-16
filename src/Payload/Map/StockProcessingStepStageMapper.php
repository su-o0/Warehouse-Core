<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\StockProcessingStepStageEnum;

final class StockProcessingStepStageMapper implements Mapper {
    public static function match(
        string $field
    ) : StockProcessingStepStageEnum {
        return match ($field) {
            'Placed'    => StockProcessingStepStageEnum::Placed,
            default         => throw DomainException::STOCK_PROCESSING_STEP_STAGE_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw,
        string $field
    ): StockProcessingStepStageEnum {
       return self::match($raw[$field]);
    }
}