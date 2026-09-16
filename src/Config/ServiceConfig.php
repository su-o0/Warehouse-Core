<?php
namespace WarehouseCore\Config;

final readonly class ServiceConfig {
    use ConfigHelper;
    public function __construct(
        public string $authentication,
        public string $area,
        public string $container,
        public string $user,
        public string $item,
        public string $owner,
        public string $part,
        public string $physical_tag,
        public string $rack,
        public string $sales,
        public string $shelf,
        public string $storage_slot,
        public string $stock,
        public string $vehicle,
        public string $zone,
        public string $find,
        public string $get,
        public string $list,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            authentication: self::requiredString($raw, 'Authentication'),
            area: self::requiredString($raw, 'Area'),
            container: self::requiredString($raw, 'Container'),
            user: self::requiredString($raw, 'User'),
            item: self::requiredString($raw, 'Item'),
            owner: self::requiredString($raw, 'Owner'),
            part: self::requiredString($raw, 'Part'),
            physical_tag: self::requiredString($raw, 'PhysicalTag'),
            rack: self::requiredString($raw, 'Rack'),
            sales: self::requiredString($raw, 'Sales'),
            shelf: self::requiredString($raw, 'Shelf'),
            storage_slot: self::requiredString($raw, 'StorageSlot'),
            stock: self::requiredString($raw, 'Stock'),
            vehicle: self::requiredString($raw, 'Vehicle'),
            zone: self::requiredString($raw, 'Zone'),
            find: self::requiredString($raw, 'Find'),
            get: self::requiredString($raw, 'Get'),
            list: self::requiredString($raw, 'List'),
        );
    }
}