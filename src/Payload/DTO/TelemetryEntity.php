<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Type\TelemetryType;

use WarehouseCore\Payload\Type\ActionType;
use WarehouseCore\Payload\Value\TelemetryTypeValue;
use WarehouseCore\Payload\Value\ActionTypeValue;

final class TelemetryEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly TelemetryType $entity_type,
        public readonly int $entity_id,
        public readonly ActionType $action,
        public readonly string $payload,
        public readonly string $user_id,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            entity_type: TelemetryTypeValue::fromRaw($raw, 'entity_type'),
            entity_id: self::requiredString($raw, 'entity_id'),
            action: ActionTypeValue::fromRaw($raw, 'action'),
            payload: self::requiredString($raw, 'payload'),
            user_id: self::requiredString($raw, 'user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}