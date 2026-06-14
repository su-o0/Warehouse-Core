<?php
namespace WarehouseCore\Type;

enum PhysicalTagStatus: string {
    case Free     = 'Free';
    case Assigned = 'Assigned';
    case Lost     = 'Lost';
    case Broken   = 'Broken';
}