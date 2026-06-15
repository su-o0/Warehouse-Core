<?php
namespace WarehouseCore\Payload\Type; 

enum ItemCondition: string {
    case New    = 'New';
    case Good   = 'Good';
    case Fair   = 'Fair';
    case Poor   = 'Poor';
}