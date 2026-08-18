<?php
namespace WarehouseCore\Payload\Enum;

enum PlacementTargetEnum : string {
    case Zone       = 'Zone';
    case Shelf      = 'Shelf';
    case Container  = 'Container';
}