<?php 
namespace WarehouseCore\Payload\Enum;

enum ProviderNameEnum : string {
    case Shell = 'Shell';
    case Web = 'Web';
    case Telegram = 'Telegram';
}