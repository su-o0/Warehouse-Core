<?php
namespace WarehouseCore\Payload\VO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\UserProcessingStepStageEnum;
use WarehouseCore\Payload\Map\UserProcessingStepStageMapper;

final class UserProcessingStepVO {
    use ConfigHelper;
    public function __construct(
        public int $record_id,
        public int $user_id,
        public UserProcessingStepStageEnum $stage,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            record_id: self::requiredInt($raw, 'record_id'),
            user_id: self::requiredInt($raw, 'user_id'),
            stage: UserProcessingStepStageMapper::match(
                self::requiredString($raw, 'stage')
            ),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}