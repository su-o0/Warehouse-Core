<?php 
namespace WarehouseCore\Payload\Enum;

enum ApiTypeEnum : string {
    case Command = 'command';
    case Query = 'query';
}