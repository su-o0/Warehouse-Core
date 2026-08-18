<?php
namespace WarehouseCore\Payload\Enum;

enum StockStatusEnum : string {
    case Created    = 'Created';
    case Placed     = 'Placed';
    case Active     = 'Active';
    case Adjusted   = 'Adjusted';
    case Crowded    = 'Crowded';
    case Archived   = 'Archived';
}