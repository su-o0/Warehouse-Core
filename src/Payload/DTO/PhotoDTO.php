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

    public static function container(int $id): self {
        return new self(PhotoSubjectEnum::Container, $id);
    }

    public static function rack(int $id): self {
        return new self(PhotoSubjectEnum::Rack, $id);
    }

    public static function user(int $id): self {
        return new self(PhotoSubjectEnum::User, $id);
    }

    public static function zone(int $id): self {
        return new self(PhotoSubjectEnum::Zone, $id);
    }
}
