<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

final class StorageFileEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly string $path,
        public readonly string $hash,
        public readonly string $mime_type,
        public readonly string $size,
        public readonly int $created_by_user_id,
        public readonly string $created_at
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