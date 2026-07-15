<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ItemProcessingStage;

final class ItemProcessingStageMapper {
    public static function fromRaw(
        array $raw,
        string $field
    ): ItemProcessingStage {
        return match ($raw[$field]) {
            'Photo' => ItemProcessingStage::Photo,
            'Condition' => ItemProcessingStage::Condition,
            'Vision' => ItemProcessingStage::Vision,
            'Placement' => ItemProcessingStage::Placement,
            default => throw DomainException::ITEM_PROCESSING_STAGE_INVALID_TYPE()
        };
    }
}
    