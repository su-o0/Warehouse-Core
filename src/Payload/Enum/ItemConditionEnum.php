<?php
namespace WarehouseCore\Payload\Enum; 

enum ItemConditionEnum: string {
    case New    = 'New';
    case Good   = 'Good';
    case Fair   = 'Fair';
    case Poor   = 'Poor';
}