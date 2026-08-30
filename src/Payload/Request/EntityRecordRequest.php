<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class EntityRecordRequest {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public int $record_id,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            record_id: self::requiredInt($raw, 'record_id'),
        );
    }
}