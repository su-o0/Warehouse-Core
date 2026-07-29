<?php
namespace WarehouseCore\Payload\Type;

enum PlacementEntity : string {
    case Container  = 'Container';
    case Item       = 'Item';
    case Stock      = 'Stock';
}