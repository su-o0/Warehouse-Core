<?php
namespace WarehouseCore\Payload\Enum;

enum PhysicalTagStatusEnum: string {
    case Free     = 'Free';
    case Assigned = 'Assigned';
    case Lost     = 'Lost';
    case Broken   = 'Broken';
}