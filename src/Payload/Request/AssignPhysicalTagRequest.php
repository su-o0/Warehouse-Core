<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class AssignPhysicalTagRequest {
    use ConfigHelper;
    public function __construct(
        public int $physical_tag_id,
        public ?int $owner_id,
        public ?int $vehicle_id
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            physical_tag_id: self::requiredInt($raw, 'physical_tag_id'),
            owner_id: self::nullableInt($raw, 'owner_id'),
            vehicle_id: self::nullableInt($raw, 'vehicle_id')
        );
    }
}