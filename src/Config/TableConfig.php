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
        public readonly string $owner,
        public readonly string $physical_tag,
    ) { }

    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            self::requiredString($raw, 'Location'),
            self::requiredString($raw, 'ContainerPlacement'),
            self::requiredString($raw, 'ItemPlacement'),
            self::requiredString($raw, 'StockPlacement'),
            self::requiredString($raw, 'Container'),
            self::requiredString($raw, 'Item'),
            self::requiredString($raw, 'Stock'),
            self::requiredString($raw, 'Part'),
            self::requiredString($raw, 'Vehicle'),
            self::requiredString($raw, 'ItemPhoto'),
            self::requiredString($raw, 'StockPhoto'),
            self::requiredString($raw, 'VehiclePhoto'),
            self::requiredString($raw, 'Event'),
            self::requiredString($raw, 'ItemSalesArhive'),
            self::requiredString($raw, 'StockSalesArhive'),
            self::requiredString($raw, 'User'),
            self::requiredString($raw, 'Owner'),
            self::requiredString($raw, 'PhysicalTag'),
        );
    }
}