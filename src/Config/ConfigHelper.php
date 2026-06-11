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
}