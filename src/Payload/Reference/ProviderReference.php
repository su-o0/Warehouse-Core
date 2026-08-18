<?php 
namespace WarehouseCore\Payload\Reference;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ProviderNameMapper;
use WarehouseCore\Payload\Enum\ProviderNameEnum;

final readonly class ProviderReference {
    use ConfigHelper;
    public function __construct(
        public ProviderNameEnum $name
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            name: ProviderNameMapper::match(self::requiredString($raw, 'name'))
        );
    }
}
