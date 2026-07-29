<?php
namespace WarehouseCore\Payload\Type;

enum LocationStatus: string {
    case Created    = 'Created';
    case Active     = 'Active';
    case Archived   = 'Archived';
}