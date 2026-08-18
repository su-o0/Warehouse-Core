<?php 
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\Enum\OwnerStatusEnum;
use WarehouseCore\Payload\Map\OwnerStatusMapper;

final readonly class OwnerEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public int $user_id,
        public OwnerStatusEnum $status,
        public int $created_by_user_id,
        public string $created_at
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            user_id: self::requiredInt($raw, 'user_id'),
            status: OwnerStatusMapper::match(
               self::requiredString($raw, 'status')
            ),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}