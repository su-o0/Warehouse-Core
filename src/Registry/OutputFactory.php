<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Output\Output;
use WarehouseCore\Payload\Type\ProviderType;

final class OutputFactory {
    public static function Output(
        ProviderType $provider
    ): Output {
        return match ($provider) {
            ProviderType::Cli => self::cli(),
            default => throw new \RuntimeException("Unknown provider")
        };
    }

    private static function cli(): Output {
        return OutputCli::create();
    }
}