<?php
namespace WarehouseCore\Payload\Enum;

enum OwnerStatusEnum : string {
    case Active = 'Active';
    case Archived = 'Archived';
}