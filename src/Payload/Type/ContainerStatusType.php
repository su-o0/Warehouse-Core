<?php
namespace WarehouseCore\Payload\Type;

enum ContainerStatus : string {
    case Created    = 'Created';
    case Active     = 'Active';
    case Crowded    = 'Crowded';
    case Archived   = 'Archived';
    case Lost       = 'Lost';
}