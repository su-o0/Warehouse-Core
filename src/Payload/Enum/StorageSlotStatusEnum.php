<?php 
namespace WarehouseCore\Payload\Enum;

enum StorageSlotStatusEnum : string {
    case Registered = "Registered";
    case Active = "Active";
    case Crowded = "Crowded";
    case Archived = "Archived";
}