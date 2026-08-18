<?php
namespace WarehouseCore\Payload\Enum;

enum ZoneStatusEnum: string {
    case Created    = 'Created';
    case Active     = 'Active';
    case Crowded    = 'Crowded';
    case Archived   = 'Archived';
}