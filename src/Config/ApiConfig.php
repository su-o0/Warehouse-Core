<?php
namespace WarehouseCore\Config;

use WarehouseCore\Config\Api\AreaApiConfig;
use WarehouseCore\Config\Api\ContainerApiConfig;
use WarehouseCore\Config\Api\ItemApiConfig;
use WarehouseCore\Config\Api\OwnerApiConfig;
use WarehouseCore\Config\Api\PartApiConfig;
use WarehouseCore\Config\Api\PhysicalTagApiConfig;
use WarehouseCore\Config\Api\RackApiConfig;
use WarehouseCore\Config\Api\SalesApiConfig;
use WarehouseCore\Config\Api\ShelfApiConfig;
use WarehouseCore\Config\Api\StockApiConfig;
use WarehouseCore\Config\Api\StorageSlotApiConfig;
use WarehouseCore\Config\Api\UserApiConfig;
use WarehouseCore\Config\Api\VehicleApiConfig;
use WarehouseCore\Config\Api\ZoneApiConfig;
use WarehouseCore\Contract\Config;

final readonly class ApiConfig implements Config {
    use ConfigHelper;
 
    public function __construct(
        public AreaApiConfig $area,
        public ContainerApiConfig $container,
        public ItemApiConfig $item,
        public OwnerApiConfig $owner,
        public PartApiConfig $part,
        public PhysicalTagApiConfig $physical_tag,
        public RackApiConfig $rack,
        public SalesApiConfig $sales,
        public ShelfApiConfig $shelf,
        public StorageSlotApiConfig $storage_slot,
        public StockApiConfig $stock,
        public UserApiConfig $user,
        public VehicleApiConfig $vehicle,
        public ZoneApiConfig $zone
    ) { }
 
    public static function fromRaw(
        array $raw
    ): self {
        return new self(
            area: AreaApiConfig::fromRaw(
                self::required($raw, 'Area')
            ),
            container: ContainerApiConfig::fromRaw(
                self::required($raw, 'Container')
            ),
            item: ItemApiConfig::fromRaw(
                self::required($raw, 'Item')
            ),
            owner: OwnerApiConfig::fromRaw(
                self::required($raw, 'Owner')
            ),
            part: PartApiConfig::fromRaw(
                self::required($raw, 'Part')
            ),
            physical_tag: PhysicalTagApiConfig::fromRaw(
                self::required($raw, 'PhysicalTag')
            ),
            rack: RackApiConfig::fromRaw(
                self::required($raw, 'Rack')
            ),
            sales: SalesApiConfig::fromRaw(
                self::required($raw, 'Sales')
            ),
            shelf: ShelfApiConfig::fromRaw(
                self::required($raw, 'Shelf')
            ),
            storage_slot: StorageSlotApiConfig::fromRaw(
                self::required($raw, 'StorageSlot')
            ),
            stock: StockApiConfig::fromRaw(
                self::required($raw, 'Stock')
            ),
            user: UserApiConfig::fromRaw(
                self::required($raw, 'User')
            ),
            vehicle: VehicleApiConfig::fromRaw(
                self::required($raw, 'Vehicle')
            ),
            zone: ZoneApiConfig::fromRaw(
                self::required($raw, 'Zone')
            )
        );
    }
}