<?php
namespace WarehouseCore\Payload\Request;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ContainerTypeMapper;
use WarehouseCore\Payload\Type\ContainerType;

final readonly class CreateContainerRequest {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public ContainerType $type
    ) {}

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            type: ContainerTypeMapper::fromString(
                self::requiredString($raw, 'type')
            )
        );
    }
}