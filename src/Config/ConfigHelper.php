<?php 
namespace WarehouseCore\Config;

use WarehouseCore\Exception\ValidationException;

//TODO: Replace with RawReader
trait ConfigHelper {
    private static function required(
        array $raw, 
        string $field
    ): mixed {
        return $raw[$field] ?? throw ValidationException::FIELD_MISSING($field);
    }

    protected static function requiredString(
        array $raw, 
        string $field
    ): string {
        $v = self::required($raw, $field);
        if (!is_string($v)) {
            throw ValidationException::INVALID_TYPE($field, 'string');
        }
        return $v;
    }

    protected static function requiredInt(
        array $raw, 
        string $field
    ): int {
        $v = self::required($raw, $field);
        if (!is_numeric($v)) {
            throw ValidationException::INVALID_TYPE($field, 'int');
        }
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

    protected static function nullableString(
        array $raw,
        string $field
    ): ?string {
        if (!isset($raw[$field])) {
            return null;
        }

        if ($raw[$field] === null) {
            return null;
        }

        return (string)$raw[$field];
    }

    public static function xor(?int $a, ?int $b): bool {
        return ($a !== null) !== ($b !== null);
    }

    public static function xor3(?int $a, ?int $b, ?int $c): bool {
        return (($a !== null ? 1 : 0) +
            ($b !== null ? 1 : 0) +
            ($c !== null ? 1 : 0)
        ) === 1;
    } 
}