<?php
namespace WarehouseCore\Payload\Type;

enum ItemStatus : string {
    case Created    = 'Created';
    case Tagged     = 'Tagged';
    case Placed     = 'Placed';
    case Active     = 'Active';
    case Sold       = 'Sold';
    case Archived   = 'Archived';
    case Lost       = 'Lost';
}