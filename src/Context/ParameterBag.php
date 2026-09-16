<?php
declare(strict_types=1);
namespace WarehouseCore\Context;
use WarehouseCore\Exception\ValidationException;

final class ParameterBag {
    private readonly array $values;

    public function __construct(
        array $raw,
        array $parameters
    ) {
        $built = [];

        foreach ($parameters as $name => $raw_spec) {
            $spec = $this->normalizeSpec($raw_spec);

            if (!array_key_exists($name, $raw)) {
                $built[$name] = $this->resolveMissing($name, $spec);
                continue;
            }

            $value = $raw[$name];

            if ($value === null) {
                if (!$spec['nullable']) {
                    throw ValidationException::BAG_TYPE_MISMATCH($name);
                }
                $built[$name] = null;
                continue;
            }

            $this->assertType($name, $value, $spec['type']);
            $built[$name] = $value;
        }

        $this->values = $built;
    }

    private function normalizeSpec(
        string|array $raw_spec
    ): array {
        if (is_string($raw_spec)) {
            $nullable = str_starts_with($raw_spec, '?');
            $type = $nullable ? substr($raw_spec, 1) : $raw_spec;

            return [
                'type' => $type,
                'required' => true,
                'nullable' => $nullable,
                'has_default' => false,
                'default' => null,
            ];
        }

        if (!isset($raw_spec['type'])) {
            throw ValidationException::BAG_SCHEMA_ERROR();
        }

        $has_default = array_key_exists('default', $raw_spec);

        return [
            'type' => $raw_spec['type'],
            'required' => $raw_spec['required'] ?? !$has_default,
            'nullable' => $raw_spec['nullable'] ?? false,
            'has_default' => $has_default,
            'default' => $raw_spec['default'] ?? null,
        ];
    }

    private function resolveMissing(
        string $name,
        array $spec
    ): mixed {
        if ($spec['required']) {
            throw ValidationException::BAG_MISSING_PARAMETER($name);
        }

        return $spec['has_default'] ? $spec['default'] : null;
    }

    public function __get(
        string $name
    ): mixed {
        if (!array_key_exists($name, $this->values)) {
            throw ValidationException::BAG_NOT_FOUND_PARAMETER($name);
        }

        return $this->values[$name];
    }

    public function __isset(
        string $name
    ): bool {
        return array_key_exists($name, $this->values);
    }

    private function assertType(
        string $name,
        mixed $value,
        string $type
    ): void {
        $isValid = match ($type) {
            'int'    => is_int($value),
            'string' => is_string($value),
            'bool'   => is_bool($value),
            'float'  => is_float($value) || is_int($value),
            'array'  => is_array($value),
            default  => throw ValidationException::BAG_UNKNOWN_TYPE($name, $type),
        };

        if (!$isValid) {
            $actual = get_debug_type($value);
            throw ValidationException::BAG_TYPE_WAIT_MISMATCH($name, $type, $actual);
        }
    }

    public function toArray(): array {
        return $this->values;
    }
}
