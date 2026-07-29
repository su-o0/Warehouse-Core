<?php
namespace WarehouseCore\Payload\Type;

enum PlacementTarget : string {
    case Location   = 'Location';
    case Container  = 'Container';
}