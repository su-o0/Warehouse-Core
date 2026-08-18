<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Payload\Enum\VideoSubjectEnum;

final readonly class VideoDTO {
    private function __construct(
        public VideoSubjectEnum $type,
        public int $id,
    ) {}

    public static function part(int $id): self {
        return new self(VideoSubjectEnum::Part, $id);
    }

    public static function item(int $id): self {
        return new self(VideoSubjectEnum::Item, $id);
    }

    public static function stock(int $id): self {
        return new self(VideoSubjectEnum::Stock, $id);
    }

    public static function vehicle(int $id): self {
        return new self(VideoSubjectEnum::Vehicle, $id);
    }
}
