<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class EntityValueRequest {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public string $value
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            value: self::nullableString($raw, 'value')
        );
    }
}