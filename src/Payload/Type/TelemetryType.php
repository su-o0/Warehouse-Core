<?php
namespace WarehouseCore\Payload\Type;

enum TelemetryType: string {
    case Location       = 'Location';
    case Container      = 'Container';
    case Item           = 'Item';
    case Stock          = 'Stock';
    case User           = 'User';
    case UserIdentity   = 'UserIdentity';
    case Owner          = 'Owner';
    case PhysicalTag    = 'PhysicalTag';
    case ItemPhoto      = 'ItemPhoto';
    case StockPhoto     = 'StockPhoto';
    case VehiclePhoto   = 'VehiclePhoto';
    case Part           = 'Part';
    case Vehicle        = 'Vehicle';
}