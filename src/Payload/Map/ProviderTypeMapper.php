<?php
namespace WarehouseCore\Payload\Map;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Exception\DomainException;

final class ProviderTypeMapper {
    public static function fromRaw(
        array $raw, 
        string $field
    ): ProviderType {
        return match($raw[$field]){
            'Cli'       => ProviderType::Cli,
            'Web'       => ProviderType::Web,
            'Telegram'  => ProviderType::Telegram,
            default     => throw DomainException::PROVIDER_INVALID_TYPE()
        };
    }

    public static function fromString(
        string $value
    ): ProviderType {
        return match($value){
            'Cli'       => ProviderType::Cli,
            'Web'       => ProviderType::Web,
            'Telegram'  => ProviderType::Telegram,
            default     => throw DomainException::PROVIDER_INVALID_TYPE()
        };
    }
}
