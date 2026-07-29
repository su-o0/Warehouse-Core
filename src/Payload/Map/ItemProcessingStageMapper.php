<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ItemProcessingStage;

final class ItemProcessingStageMapper implements Mapper {
    public static function match(
        string $field
    ) : ItemProcessingStage {
        return match ($field) {
            'Identify' => ItemProcessingStage::Identify,
            'Photo' => ItemProcessingStage::Photo,
            'Inspection' => ItemProcessingStage::Inspection,
            'Placement' => ItemProcessingStage::Placement,
            default => throw DomainException::ITEM_PROCESSING_STAGE_INVALID_TYPE()
        };
    }
    
    public static function fromRaw(
        array $raw,
        string $field
    ): ItemProcessingStage {
       return self::match($raw[$field]);
    }
}
    