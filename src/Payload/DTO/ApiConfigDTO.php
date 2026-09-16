<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\ApiTypeEnum;
use WarehouseCore\Payload\Map\ApiTypeMapper;

final readonly class ApiConfigDTO {
    use ConfigHelper;

    public function __construct(
        public string $name,
        public ApiTypeEnum $type,
        public array $parameters
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            name: self::requiredString($raw, 'name'),
            type: ApiTypeMapper::match(
                self::requiredString($raw, 'type'),
            ),
            parameters: self::required($raw, 'parameters')
        );
    }
}