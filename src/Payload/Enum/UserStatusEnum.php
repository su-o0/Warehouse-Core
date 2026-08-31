<?php 
namespace WarehouseCore\Payload\Enum;

enum UserStatusEnum : string {
    case Created    = 'Created';
    case Processing = 'Processing';
    case Active     = 'Active';
    case Archived   = 'Archived';
}