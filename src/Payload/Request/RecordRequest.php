<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;

final readonly class RecordRequest {
    use ConfigHelper;
    public function __construct(
        public int $record_id,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            record_id: self::requiredInt($raw, 'record_id'),
        );
    }
}