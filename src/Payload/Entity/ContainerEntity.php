<?php 
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\ContainerStatusMapper;
use WarehouseCore\Payload\Map\ContainerTypeMapper;
use WarehouseCore\Payload\Enum\ContainerStatusEnum;
use WarehouseCore\Payload\Enum\ContainerTypeEnum;

final readonly class ContainerEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public ContainerTypeEnum $type,
        public ContainerStatusEnum $status,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            type: ContainerTypeMapper::match(
               self::requiredString($raw, 'type')
            ),
            status: ContainerStatusMapper::match(
               self::requiredString($raw, 'type')
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}