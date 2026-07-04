<?php 
namespace WarehouseCore\Payload\Type;

enum ProviderType : string {
    case Cli = 'Cli';
    case Web = 'Web';
    case Telegram = 'Telegram';
}