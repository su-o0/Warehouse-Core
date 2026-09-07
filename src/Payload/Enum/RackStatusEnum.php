<?php
namespace WarehouseCore\Payload\Enum;

enum RackStatusEnum : string {
    case Registered = 'Registered';
    case Processing = 'Processing';
    case Active     = 'Active';
    case Crowded    = 'Crowded';
    case Archived   = 'Archived';
}