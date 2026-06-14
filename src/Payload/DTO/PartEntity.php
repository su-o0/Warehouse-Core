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
            self::requiredInt($raw, 'id'),
            self::requiredString($raw, 'article'),
            self::requiredString($raw, 'name'),
            self::requiredString($raw, 'created_at'),
        );
    } 
}