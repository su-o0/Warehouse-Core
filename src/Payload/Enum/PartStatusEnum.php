<?php 
namespace WarehouseCore\Payload\Enum;

enum PartStatusEnum : string {
    case Created    = 'Created';
    case Processing = 'Processing';
    case Active     = 'Active';
    case Archived   = 'Archived';
}