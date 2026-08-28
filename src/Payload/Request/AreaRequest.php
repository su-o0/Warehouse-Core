<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class AreaRequest {
    use ConfigHelper;
    public function __construct(
        public int $area_id,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            area_id: self::requiredInt($raw, 'area_id'),
        );
    }
}