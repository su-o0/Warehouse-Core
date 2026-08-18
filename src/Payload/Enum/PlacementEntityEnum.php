<?php
namespace WarehouseCore\Payload\Enum;

enum PlacementEntityEnum : string {
    case Zone       = 'Zone';
    case Rack       = 'Rack';
    case Container  = 'Container';
    case Item       = 'Item';
    case Stock      = 'Stock';
}