<?php 
namespace WarehouseCore\Payload\Enum;

enum ShelfStatusEnum : string {
    case Registered = "Registered";
    case Active = "Active";
    case Crowded = "Crowded";
    case Archived = "Archived";
}