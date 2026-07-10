<?php

namespace WarehouseCore\Payload\Value;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\TelemetryType;

final class TelemetryTypeValue
{
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
