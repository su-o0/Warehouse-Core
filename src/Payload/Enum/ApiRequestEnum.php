<?php 
namespace WarehouseCore\Payload\Enum;

enum ApiRequestEnum : string {
    case AddUserIdentity = 'add_user_identity';
    case UserIdentity = 'user_identity';
    case Entity = 'entity';
    case Record = 'record';
    case Value = 'value';
    case EntityRecord = 'entity_record';
    case Bag = 'bag';
}