<?php
namespace WarehouseCore\Payload\Value;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Exception\DomainException;

final class ProviderTypeValue {
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
}
