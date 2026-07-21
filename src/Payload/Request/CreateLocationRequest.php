<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Value\AddressValue;

final readonly class CreateLocationRequest {
    use ConfigHelper;
    public function __construct(
        public AddressValue $address,
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            AddressValue::fromRawRequest($raw)
        );
    }
}