<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\TelemetryType;

final class TelemetryTypeMapper {
    public static function fromRaw(
        array $raw,
        string $field
    ): TelemetryType {
        return match ($raw[$field]) {
            'Location' => TelemetryType::Location,
            'Container' => TelemetryType::Container,
            'Item' => TelemetryType::Item,
            'Stock' => TelemetryType::Stock,
            'User' => TelemetryType::User,
            'UserIdentity' => TelemetryType::UserIdentity,
            'Owner' => TelemetryType::Owner,
            'PhysicalTag' => TelemetryType::PhysicalTag,
            default => throw DomainException::TELEMETRY_INVALID_TYPE()
        };
    }
}
