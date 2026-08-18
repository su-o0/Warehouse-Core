<?php 
namespace WarehouseCore\Payload\Entity;

use WarehouseCore\Config\ConfigHelper;
use WarehouseCore\Payload\DTO\VideoDTO;

final readonly class VideoVO {
    use ConfigHelper;

    public function __construct(
        public string $file,
        public VideoDTO $owner,
        public int $stored_file_id,
        public string $created_at,
    ) {}

    public static function fromPartRaw(array $raw): self {
        return new self(
            file: self::requiredString($raw, 'file'),
            owner: VideoDTO::part(self::requiredInt($raw, 'part_id')),
            stored_file_id: self::requiredInt($raw, 'stored_file_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }

    public static function fromItemRaw(array $raw): self {
        return new self(
            file: self::requiredString($raw, 'file'),
            owner: VideoDTO::item(self::requiredInt($raw, 'item_id')),
            stored_file_id: self::requiredInt($raw, 'stored_file_id'),
            created_at: self::requiredString($raw, 'created_at'),
        );
    }

}