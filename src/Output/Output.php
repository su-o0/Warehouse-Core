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
            ProviderNameEnum::Shell => ShellOutputRegistry::create(),
            default => throw ServiceException::PROVIDER_NOT_FOUND()
        };
    }

    public function render(object $result): mixed
    {
        return $this->dispatcher->render($result);
    }
}