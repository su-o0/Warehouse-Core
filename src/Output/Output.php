<?php
namespace WarehouseCore\Output;

use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Enum\ProviderNameEnum;
use WarehouseCore\Registry\ShellOutputRegistry;

final class Output {
    public function __construct(
        private Dispatcher $dispatcher
    ) {}

    public static function create(
        ProviderNameEnum $provider
    ): self {
        return match ($provider) {
            ProviderNameEnum::Shell => self::shell(),
            default => throw ServiceException::PROVIDER_NOT_FOUND()
        };
    }

    private static function shell(): Output {
        return ShellOutputRegistry::create();
    }
    
    public function render(object $result): mixed
    {
        return $this->dispatcher->render($result);
    }
}