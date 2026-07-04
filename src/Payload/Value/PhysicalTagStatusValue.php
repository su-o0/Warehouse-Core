<?php 
namespace WarehouseCore\Payload\Value;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\PhysicalTagStatus;

final class PhysicalTagStatusValue {
    public static function fromRaw(
        array $raw, 
        string $field
    ): PhysicalTagStatus {
        return match($raw[$field]){
            'Free'      => PhysicalTagStatus::Free,
            'Assigned'  => PhysicalTagStatus::Assigned,
            'Lost'      => PhysicalTagStatus::Lost,
            'Broken'    => PhysicalTagStatus::Broken,
            default     => throw DomainException::PHYSICAL_TAG_INVALID_STATUS()
        };
    }
}