<?php
namespace WarehouseCore\Config\Api;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\ApiConfigDTO;

final class VehicleApiConfig {
    use ConfigHelper;

    public function __construct(
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
        );
    }
}