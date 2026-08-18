<?php
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Payload\Enum\PhotoSubjectEnum;

final readonly class PhotoDTO {
    private function __construct(
        public PhotoSubjectEnum $type,
        public int $id,
    ) {}

    public static function part(int $id): self {
        return new self(PhotoSubjectEnum::Part, $id);
    }

    public static function item(int $id): self {
        return new self(PhotoSubjectEnum::Item, $id);
    }

    public static function stock(int $id): self {
        return new self(PhotoSubjectEnum::Stock, $id);
    }

    public static function vehicle(int $id): self {
        return new self(PhotoSubjectEnum::Vehicle, $id);
    }
}
