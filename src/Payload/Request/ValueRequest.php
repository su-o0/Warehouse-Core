<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class ValueRequest {
    use ConfigHelper;
    public function __construct(
        public string $value,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            value: self::requiredString($raw, 'value'),
        );
    }
}