<?php
namespace WarehouseCore\Payload\Type;

enum ContainerStatus : string {
    case Created    = 'Created';
    case Active     = 'Active';
    case Sold       = 'Crowded';
    case Archived   = 'Archived';
    case Lost       = 'Lost';
}