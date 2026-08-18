<?php 
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\PhotoDTO;

final readonly class PhotoVO {
    use ConfigHelper;

    public function __construct(
        public string $file,
        public PhotoDTO $owner,
        public int $stored_file_id,
        public string $created_at,
    ) {}

    public static function fromPartRaw(array $raw): self {
        return new self(
            file: self::requiredString($raw, 'file'),
            owner: PhotoDTO::part(self::requiredInt($raw, 'part_id')),
            stored_file_id: self::requiredInt($raw, 'stored_file_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }

    public static function fromItemRaw(array $raw): self {
        return new self(
            file: self::requiredString($raw, 'file'),
            owner: PhotoDTO::item(self::requiredInt($raw, 'item_id')),
            stored_file_id: self::requiredInt($raw, 'stored_file_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }

}