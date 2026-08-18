<?php
namespace WarehouseCore\Payload\Enum;

enum ItemStatusEnum : string {
    case Created    = 'Created';
    case Processing = 'Processing';
    case Active     = 'Active';
    case Sold       = 'Sold';
    case Archived   = 'Archived';
    case Lost       = 'Lost';
}