<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class ValueNameRequest {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public string $name,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            name: self::requiredString($raw, 'name'),
        );
    }
}