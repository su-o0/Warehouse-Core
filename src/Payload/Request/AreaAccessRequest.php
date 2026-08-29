<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class AreaAccessRequest {
    use ConfigHelper;
    public function __construct(
        public int $area_id,
        public int $user_id,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            area_id: self::requiredInt($raw, 'area_id'),
            user_id: self::requiredInt($raw, 'user_id'),
        );
    }
}