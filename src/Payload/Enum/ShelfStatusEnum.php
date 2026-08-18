<?php 
namespace WarehouseCore\Payload\Enum;

enum ShelfStatusEnum : string {
    case Created = "Created";
    case Active = "Active";
    case Crowded = "Crowded";
    case Archived = "Archived";
}