<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class EntityEntityRequest {
    use ConfigHelper;
    public function __construct(
        public int $first_id,
        public int $second_id,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            first_id: self::requiredInt($raw, 'first_id'),
            second_id: self::requiredInt($raw, 'second_id'),
        );
    }
}