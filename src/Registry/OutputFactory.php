<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Output\Output;
use WarehouseCore\Payload\Enum\ProviderNameEnum;

final class OutputFactory {
    public static function Output(
        ProviderNameEnum $provider
    ): Output {
        return match ($provider) {
            ProviderNameEnum::Shell => self::shell(),
            default => throw new \RuntimeException("Unknown provider")
        };
    }

    private static function shell(): Output {
        return OutputShell::create();
    }
}