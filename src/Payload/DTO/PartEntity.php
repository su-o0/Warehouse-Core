<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Config\ConfigHelper;

final class PartEntity {
    use ConfigHelper;
    public function __construct(
        public readonly int $id,
        public readonly string $article,
        public readonly string $name,
        public readonly string $created_at
    ) { }

    public static function fromRaw(array $raw): self {
        return new self(
            id: self::requiredInt($raw, 'id'),
            article: self::requiredString($raw, 'article'),
            name: self::requiredString($raw, 'name'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    } 
}