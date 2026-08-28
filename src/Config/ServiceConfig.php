<?php
namespace WarehouseCore\Config;

final readonly class ServiceConfig {
    use ConfigHelper;
    public function __construct(
        public string $area,
        public string $container,

        public string $authentication,
        public string $user,
        public string $user_identity,

        public string $item,
        public string $movement,
        public string $owner,
        public string $part,
        public string $photo,
        public string $physical_tag,
        public string $placement,
        public string $rack,
        public string $sales,
        public string $shelf,
        public string $stock,
        public string $vehicle,
        public string $video,
        public string $zone,

        public string $find,
        public string $get,
        public string $list,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            area: self::requiredString($raw, 'Area'),
            container: self::requiredString($raw, 'Container'),

            authentication: self::requiredString($raw, 'Authentication'),
            user: self::requiredString($raw, 'User'),
            user_identity: self::requiredString($raw, 'UserIdentity'),

            item: self::requiredString($raw, 'Item'),
            movement: self::requiredString($raw, 'Movement'),
            owner: self::requiredString($raw, 'Owner'),
            part: self::requiredString($raw, 'Part'),
            photo: self::requiredString($raw, 'Photo'),
            physical_tag: self::requiredString($raw, 'PhysicalTag'),
            placement: self::requiredString($raw, 'Placement'),
            rack: self::requiredString($raw, 'Rack'),
            sales: self::requiredString($raw, 'Sales'),
            shelf: self::requiredString($raw, 'Shelf'),
            stock: self::requiredString($raw, 'Stock'),
            vehicle: self::requiredString($raw, 'Vehicle'),
            video: self::requiredString($raw, 'Video'),
            zone: self::requiredString($raw, 'Zone'),

            find: self::requiredString($raw, 'Find'),
            get: self::requiredString($raw, 'Get'),
            list: self::requiredString($raw, 'List'),
        );
    }
}