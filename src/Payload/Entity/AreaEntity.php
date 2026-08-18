<?php 
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Map\AreaStatusMapper;
use WarehouseCore\Payload\Enum\AreaStatusEnum;

final readonly class AreaEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public AreaStatusEnum $status,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            status: AreaStatusMapper::match(
               self::requiredString($raw, 'status')
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}