<?php
namespace WarehouseCore\Type;

enum ItemStatus : string {
    case Active     = 'Active';
    case Sold       = 'Sold';
    case Archived   = 'Archived';
    case Lost       = 'Lost';
}