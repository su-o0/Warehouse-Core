<?php 
namespace WarehouseCore\Config;

trait ConfigHelper {
    private static function required(
        array $raw, 
        string $field
    ): mixed {
        return $raw[$field] ?? throw new \InvalidArgumentException("Missing field: {$field}");
    }

    protected static function requiredString(
        array $raw, 
        string $field
    ): string {
        $v = self::required($raw, $field);
        if (!is_string($v)) {
            throw new \InvalidArgumentException("Field '{$field}' must be string");
        }
        return $v;
    }

    protected static function requiredInt(
        array $raw, 
        string $field
    ): int {
        $v = self::required($raw, $field);
        if (!is_numeric($v))
            throw new \InvalidArgumentException("Field '{$field}' must be int");
        return (int) $v;
    }

    protected static function nullableInt(
        array $raw,
        string $field
    ): ?int {
        if (!isset($raw[$field])) {
            return null;
        }

        if ($raw[$field] === null) {
            return null;
        }

        return (int)$raw[$field];
    }
}