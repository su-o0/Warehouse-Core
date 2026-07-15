<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

final class PartAliasEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly int $part_id,
        public readonly int $article,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            part_id: self::requiredInt($raw, 'part_id'),
            article: self::requiredString($raw, 'article'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    } 
}