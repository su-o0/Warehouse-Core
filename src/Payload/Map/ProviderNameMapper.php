<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Enum\ProviderNameEnum;

final class ProviderNameMapper implements Mapper {
    public static function match(
        string $field
    ): ProviderNameEnum {
        return match($field) {
            'Shell'     => ProviderNameEnum::Shell,
            'Web'       => ProviderNameEnum::Web,
            'Telegram'  => ProviderNameEnum::Telegram,
            default     => throw DomainException::PROVIDER_NAME_INVALID_TYPE()
        };
    }
}