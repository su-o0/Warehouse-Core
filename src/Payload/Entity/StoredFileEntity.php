<?php
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;

final readonly class StoredFileEntity {
    use ConfigHelper;
    public function __construct(
        public int $id,
        public string $path,
        public string $hash,
        public string $mime_type,
        public string $size,
        public int $created_by_user_id,
        public string $created_at
    ){ }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            path: self::requiredString($raw, 'path'),
            hash: self::requiredString($raw, 'hash'),
            mime_type: self::requiredString($raw, 'mime_type'),
            size: self::requiredString($raw, 'size'),
            created_by_user_id: self::requiredInt($raw, 'created_by_user_id'),
            created_at: self::requiredString($raw, 'created_at')
        );
    }
}