<?php 
namespace WarehouseCore\Payload\DTO;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Type\PhysicalTagStatus;

final class PhysicalTagStatusValue {

    public static function fromRaw(string $raw): PhysicalTagStatus {
        return match($raw){
            'Free'      => PhysicalTagStatus::Free,
            'Assigned'  => PhysicalTagStatus::Assigned,
            'Lost'      => PhysicalTagStatus::Lost,
            'Broken'    => PhysicalTagStatus::Broken,
            default     => DomainException::PHYSICAL_TAG_INVALID_STATUS()
        };
    }
}