<?php
namespace WarehouseCore\Config;

final class RepositoryConfig {
    use ConfigHelper;
    public function __construct(
        public readonly string $location,
        public readonly string $container_placement,
        public readonly string $item_placement,
        public readonly string $stock_placement,
        public readonly string $container,
        public readonly string $item,
        public readonly string $stock,
        public readonly string $item_processing_step,
        public readonly string $part,
        public readonly string $part_alias,
        public readonly string $vehicle,
        public readonly string $stored_file,
        public readonly string $part_photo,
        public readonly string $item_photo,
        public readonly string $stock_photo,
        public readonly string $vehicle_photo,
        public readonly string $telemetry,
        public readonly string $item_sales_archive,
        public readonly string $stock_sales_archive,
        public readonly string $role,
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
            item_processing_step: self::requiredString($raw, 'ItemProcessingStep'),
            part: self::requiredString($raw, 'Part'),
            part_alias: self::requiredString($raw, 'PartAlias'),
            vehicle: self::requiredString($raw, 'Vehicle'),
            stored_file: self::requiredString($raw, 'StoredFile'),
            part_photo: self::requiredString($raw, 'PartPhoto'),
            item_photo: self::requiredString($raw, 'ItemPhoto'),
            stock_photo: self::requiredString($raw, 'StockPhoto'),
            vehicle_photo: self::requiredString($raw, 'VehiclePhoto'),
            telemetry: self::requiredString($raw, 'Telemetry'),
            item_sales_archive: self::requiredString($raw, 'ItemSalesArhive'),
            stock_sales_archive: self::requiredString($raw, 'StockSalesArhive'),
            role: self::requiredString($raw, 'Role'),
            user: self::requiredString($raw, 'User'),
            user_identity: self::requiredString($raw, 'UserIdentity'),
            owner: self::requiredString($raw, 'Owner'),
            physical_tag: self::requiredString($raw, 'PhysicalTag'),
        );
    }
}