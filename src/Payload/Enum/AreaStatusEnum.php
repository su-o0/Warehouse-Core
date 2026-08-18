<?php
namespace WarehouseCore\Payload\Enum;

enum AreaStatusEnum: string {
    case Created    = 'Created';
    case Active     = 'Active';
    case Crowded    = 'Crowded';
    case Archived   = 'Archived';
}