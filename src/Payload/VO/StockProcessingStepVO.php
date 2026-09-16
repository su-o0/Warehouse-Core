<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\StockProcessingStepStageMapper;
use WarehouseCore\Payload\Enum\StockProcessingStepStageEnum;

final readonly class StockProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $record_id,
        public int $stock_id,
        public StockProcessingStepStageEnum $stage,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            record_id: self::requiredInt($raw, 'record_id'),
            stock_id: self::requiredInt($raw, 'stock_id'),
            stage: StockProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}