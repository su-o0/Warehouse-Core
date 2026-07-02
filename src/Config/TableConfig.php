<?php
namespace WarehouseCore\Config;

class TableConfig {
    use ConfigHelper;
    public function __construct(
        public readonly string $location,
        public readonly string $container_placement,
        public readonly string $item_placement,
        public readonly string $stock_placement,
        public readonly string $container,
        public readonly string $item,
        public readonly string $stock,
        public readonly string $part,
        public readonly string $vehicle,
        public readonly string $item_photo,
        public readonly string $stock_photo,
        public readonly string $vehicle_photo,
        public readonly string $event,
        public readonly string $item_sales_archive,
        public readonly string $stock_sales_archive,
        public readonly string $user,
        public readonly string $user_identity,
        public readonly string $owner,
        public readonly string $physical_tag,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            location: self::requiredString($raw, 'Location'),
            container_placement: self::requiredString($raw, 'ContainerPlacement'),
            item_placement: self::requiredString($raw, 'ItemPlacement'),
            stock_placement: self::requiredString($raw, 'StockPlacement'),
            container: self::requiredString($raw, 'Container'),
            item: self::requiredString($raw, 'Item'),
            stock: self::requiredString($raw, 'Stock'),
            part: self::requiredString($raw, 'Part'),
            vehicle: self::requiredString($raw, 'Vehicle'),
            item_photo: self::requiredString($raw, 'ItemPhoto'),
            stock_photo: self::requiredString($raw, 'StockPhoto'),
            vehicle_photo: self::requiredString($raw, 'VehiclePhoto'),
            event: self::requiredString($raw, 'Event'),
            item_sales_archive: self::requiredString($raw, 'ItemSalesArhive'),
            stock_sales_archive: self::requiredString($raw, 'StockSalesArhive'),
            user: self::requiredString($raw, 'User'),
            user_identity: self::requiredString($raw, 'UserIdentity'),
            owner: self::requiredString($raw, 'Owner'),
            physical_tag: self::requiredString($raw, 'PhysicalTag'),
        );
    }
}