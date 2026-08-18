<?php
namespace WarehouseCore\Payload\Enum;

enum RackStatusEnum : string {
    case Created    = 'Created';
    case Active     = 'Active';
    case Crowded    = 'Crowded';
    case Archived   = 'Archived';
}