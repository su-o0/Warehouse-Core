<?php
namespace WarehouseCore\Payload\Enum;

enum ContainerStatusEnum : string {
    case Created    = 'Created';
    case Active     = 'Active';
    case Crowded    = 'Crowded';
    case Archived   = 'Archived';
    case Lost       = 'Lost';
}