<?php
namespace WarehouseCore\Payload\Enum;

enum ContainerStatusEnum : string {
    case Registered    = 'Registered';
    case Processing = 'Processing';
    case Active     = 'Active';
    case Crowded    = 'Crowded';
    case Archived   = 'Archived';
    case Lost       = 'Lost';
}