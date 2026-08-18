<?php 
namespace WarehouseCore\Payload\Enum;

enum UserStatusEnum : string {
    case Active     = 'Active';
    case Archived   = 'Archived';
}