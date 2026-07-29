<?php
namespace WarehouseCore\Payload\Map;

use WarehouseCore\Contract\Mapper;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Exception\DomainException;

final class ProviderTypeMapper implements Mapper{
    public static function match(
        string $field
    ): ProviderType {
        return match($field){
            'Cli'       => ProviderType::Cli,
            'Web'       => ProviderType::Web,
            'Telegram'  => ProviderType::Telegram,
            default     => throw DomainException::PROVIDER_TYPE_INVALID_TYPE()
        };
    }
}
