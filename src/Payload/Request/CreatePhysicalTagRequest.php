<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class CreatePhysicalTagRequest {
    use ConfigHelper;
    public function __construct(
        public int $id,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
        );
    }
}